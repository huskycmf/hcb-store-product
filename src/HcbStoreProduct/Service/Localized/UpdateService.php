<?php
namespace HcbStoreProduct\Service\Localized;

use HcBackend\Service\PageBinderServiceInterface;
use HcBackend\Service\ImageBinderServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use HcbStoreProduct\Data\LocalizedInterface;
use HcbStoreProduct\Entity\Product\Localized;
use HcbStoreProduct\Service\Localized\Characteristic\CharacteristicBinderService;
use HcbStoreProduct\Service\Attribute\AttributeBinderService;
use HcbStoreProductCategory\Entity\Category as CategoryEntity;
use HcbStoreProductWatched\Entity\Watched;
use HcbStoreSellStrategy\Service\Product\CrosssellBinderService;
use Zf2FileUploader\Resource\Handler\Remover\RemoverInterface;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;

class UpdateService
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var Response
     */
    protected $saveResponse;

    /**
     * @var PageBinderServiceInterface
     */
    protected $pageBinderService;

    /**
     * @var PageBinderServiceInterface
     */
    protected $imageBinderService;

    /**
     * @var CharacteristicBinderService
     */
    protected $characteristicBinderService;

    /**
     * @var AttributeBinderService
     */
    protected $attributeBinderService;

    /**
     * @var CrosssellBinderService
     */
    protected $crosssellBinderService;

    /**
     * @param EntityManagerInterface $entityManager
     * @param PageBinderServiceInterface $pageBinderService
     * @param ImageBinderServiceInterface $imageBinderService
     * @param CharacteristicBinderService $characteristicsBinderService
     * @param AttributeBinderService $attributeBinderService
     * @param CrosssellBinderService $crosssellBinderService
     * @param RemoverInterface $remover
     * @param Response $saveResponse
     */
    public function __construct(EntityManagerInterface $entityManager,
                                PageBinderServiceInterface $pageBinderService,
                                ImageBinderServiceInterface $imageBinderService,
                                CharacteristicBinderService $characteristicBinderService,
                                AttributeBinderService $attributeBinderService,
                                CrosssellBinderService $crosssellBinderService,
                                RemoverInterface $remover,
                                Response $saveResponse)
    {
        $this->pageBinderService = $pageBinderService;
        $this->imageBinderService = $imageBinderService;
        $this->characteristicBinderService = $characteristicBinderService;
        $this->attributeBinderService = $attributeBinderService;
        $this->crosssellBinderService = $crosssellBinderService;
        $this->entityManager = $entityManager;
        $this->imageRemover = $remover;
        $this->saveResponse = $saveResponse;
    }

    /**
     * @param \HcbStoreProduct\Entity\Product\Localized $productLocalizedEntity
     * @param LocalizedInterface $localizedData
     * @return Response
     */
    public function update(Localized $productLocalizedEntity,
                           LocalizedInterface $localizedData)
    {
        try {
            $this->entityManager->beginTransaction();

            $productEntity = $productLocalizedEntity->getProduct();
            $productData = $localizedData->getProductData();
            $categoryRepository = $this->entityManager
                                        ->getRepository
                                                ('HcbStoreProductCategory\Entity\Category');

            /* @var $categoryEntity CategoryEntity */
            if ($localizedData->getCategoryId() &&
                !is_null($categoryEntity = $categoryRepository->find(
                                                        $localizedData->getCategoryId() ))) {

                if (!$categoryEntity->getProduct()->contains($productEntity)) {
                    $categoryEntity->addProduct($productEntity);
                }
            }

            $this->crosssellBinderService->bind($localizedData, $productEntity);

            $watchedRepository = $this->entityManager
                                      ->getRepository
                                        ('HcbStoreProductWatched\Entity\Watched');

            $watchedEntity = $watchedRepository->createQueryBuilder('w')
                                               ->select()
                                               ->join('w.product', 'p')
                                               ->where('p = :product')
                                               ->setParameter('product', $productEntity)
                                               ->setMaxResults(1)
                                               ->getQuery()
                                               ->getOneOrNullResult();

            if ($localizedData->isWatched() != !!$watchedEntity) {
                if ($localizedData->isWatched()) {
                    $watchedEntity = new Watched();
                    $watchedEntity->setProduct($productEntity);
                    $watchedEntity->setCreatedTimestamp(new \DateTime());
                    $this->entityManager->persist($watchedEntity);
                } else {
                    $this->entityManager->remove($watchedEntity);
                }
            }
            $productEntity->setIsNew($localizedData->isNew());
            $productEntity->setEnabled($localizedData->isEnabled());

            $productLocalizedEntity->setTitle($localizedData->getTitle());
            $productLocalizedEntity->setDescription($localizedData->getDescription());

            $productEntity->setPrice($localizedData->getPrice());
            $productEntity->setPriceDeal($localizedData->getPriceDeal());

            $productLocalizedEntity->setShortDescription
                                     ($localizedData->getShortDescription());
            $productLocalizedEntity->setExtraDescription
                                     ($localizedData->getExtraDescription());

            $productEntity->setStatus($localizedData->getStatus());
            if ($localizedData->getReplaceProductId()) {
                $productEntity
                    ->setProduct($this->entityManager
                        ->getReference('HcbStoreProduct\Entity\Product',
                            $localizedData->getReplaceProductId()));
            }

            $instruction = $localizedData->getInstruction();
            if (!empty($instruction) &&
                file_exists(INDEX_DIR.$productEntity->getFileInstruction()) &&
                $productEntity->getFileInstruction() != $instruction) {
                @unlink(INDEX_DIR.$productEntity->getFileInstruction());
                $newInstructionName = '/uploaded/instructions/'.basename($instruction);
                if (!rename($instruction,
                           INDEX_DIR.$newInstructionName)) {
                    $this->saveResponse->error("Не возможно сохранить инструкцию");
                    $this->entityManager->rollback();
                    return $this->saveResponse;
                } else {
                    $productEntity->setFileInstruction($newInstructionName);
                }
            }

            $this->attributeBinderService->bind($localizedData,
                                                $productLocalizedEntity->getProduct());

            $this->characteristicBinderService->bind($localizedData, $productLocalizedEntity);

            $this->imageBinderService->bind($productData, $productEntity);

            $this->imageBinderService->bind($localizedData, $productLocalizedEntity);
            $this->pageBinderService->bind($localizedData,
                                           $productLocalizedEntity,
                                           'HcbStoreProduct\Entity\Product\Localized\Page');

            $productLocalizedEntity->getPage()
                                   ->setLocalized($productLocalizedEntity);

            $imageThumbnail = $productData->getThumbnail();

            if (!empty($imageThumbnail)) {
                $repo = $this->entityManager
                             ->getRepository('HcbStoreProduct\Entity\Product\Image');

                $repo->findOneByImage($imageThumbnail->getEntity()->getId())
                     ->setIsPreview(true);
            }

            $existsImage3dEntity = $productEntity->getImage3d();
            $image3dResource = $productData->getImage3d();

            if (!empty($image3dResource)) {
                $image3dEntity = $image3dResource->getEntity();
                if (!is_null($existsImage3dEntity) &&
                    $image3dEntity->getId() != $existsImage3dEntity->getId()) {
                    $image3dEntity->setTemporary(false);
                    $this->imageRemover->remove($existsImage3dEntity);
                }
                $productEntity->setImage3d($image3dEntity);
            } else if (!empty($existsImage3dEntity)) {
                $this->imageRemover->remove($existsImage3dEntity);
            }

            $this->entityManager->persist($productLocalizedEntity);

            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            $this->saveResponse->error($e->getMessage())->failed();
            return $this->saveResponse;
        }

        $this->saveResponse->success();
        return $this->saveResponse;
    }
}
