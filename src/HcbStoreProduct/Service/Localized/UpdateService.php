<?php
namespace HcbStoreProduct\Service\Localized;

use HcBackend\Service\PageBinderServiceInterface;
use HcBackend\Service\ImageBinderServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use HcbStoreProduct\Data\LocalizedInterface;
use HcbStoreProduct\Entity\Product\Localized;
use HcbStoreProduct\Service\Localized\Characteristic\CharacteristicBinderService;
use HcbStoreProduct\Service\Attribute\AttributeBinderService;
use Zf2FileUploader\Resource\Handler\Remover\RemoverInterface;
use Zf2Libs\Stdlib\Service\Response\Messages\ResponseInterface;

class UpdateService
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var ResponseInterface
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
     * @param EntityManagerInterface $entityManager
     * @param PageBinderServiceInterface $pageBinderService
     * @param ImageBinderServiceInterface $imageBinderService
     * @param CharacteristicBinderService $characteristicsBinderService
     * @param AttributeBinderService $attributeBinderService
     * @param RemoverInterface $remover
     * @param ResponseInterface $saveResponse
     */
    public function __construct(EntityManagerInterface $entityManager,
                                PageBinderServiceInterface $pageBinderService,
                                ImageBinderServiceInterface $imageBinderService,
                                CharacteristicBinderService $characteristicBinderService,
                                AttributeBinderService $attributeBinderService,
                                RemoverInterface $remover,
                                ResponseInterface $saveResponse)
    {
        $this->pageBinderService = $pageBinderService;
        $this->imageBinderService = $imageBinderService;
        $this->characteristicBinderService = $characteristicBinderService;
        $this->attributeBinderService = $attributeBinderService;
        $this->entityManager = $entityManager;
        $this->imageRemover = $remover;
        $this->saveResponse = $saveResponse;
    }

    /**
     * @param \HcbStoreProduct\Entity\Product\Localized $productLocalizedEntity
     * @param LocalizedInterface $localizedData
     * @return ResponseInterface
     */
    public function update(Localized $productLocalizedEntity,
                           LocalizedInterface $localizedData)
    {
        try {
            $this->entityManager->beginTransaction();

            $productEntity = $productLocalizedEntity->getProduct();
            $productData = $localizedData->getProductData();

            $this->attributeBinderService->bind($localizedData,
                                                $productLocalizedEntity->getProduct());

            $this->characteristicBinderService->bind($localizedData, $productLocalizedEntity);

            $this->imageBinderService->bind($productData, $productEntity);

            $this->imageBinderService->bind($localizedData, $productLocalizedEntity);
            $this->pageBinderService->bind($localizedData, $productLocalizedEntity);

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
                    $productEntity->setImage3d($image3dEntity);
                    $this->imageRemover->remove($existsImage3dEntity);
                }
            } else if (!empty($existsImage3dEntity)) {
                $this->imageRemover->remove($existsImage3dEntity);
            }

            $productLocalizedEntity->setTitle($localizedData->getTitle());
            $productLocalizedEntity->setDescription($localizedData->getDescription());

            $productEntity->setPrice($localizedData->getPrice());
            $productEntity->setPriceDeal($localizedData->getPriceDeal());

            $productLocalizedEntity->setShortDescription($localizedData->getShortDescription());
            $productLocalizedEntity->setExtraDescription($localizedData->getExtraDescription());
            $productEntity->setStatus($localizedData->getStatus());
            if ($localizedData->getReplaceProductId()) {
                $productEntity
                    ->setProduct($this->entityManager
                                      ->getReference('HcbStoreProduct\Entity\Product',
                                                     $localizedData->getReplaceProductId()));
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
