<?php
namespace HcbStoreProduct\Service\Localized;

use HcCore\Service\LocaleBinderServiceInterface;
use HcBackend\Service\PageBinderServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use HcbStoreProduct\Data\LocalizedInterface;
use HcbStoreProduct\Entity\Product;
use HcbStoreProduct\Stdlib\Service\Response\CreateResponse;

class CreateService
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var CreateResponse
     */
    protected $createResponse;

    /**
     * @var PageBinderServiceInterface
     */
    protected $pageBinderService;

    /**
     * @var LocaleBinderServiceInterface
     */
    protected $localeBinderService;

    /**
     * @param EntityManagerInterface $entityManager
     * @param PageBinderServiceInterface $pageBinderService
     * @param LocaleBinderServiceInterface $localeService
     * @param CreateResponse $saveResponse
     */
    public function __construct(EntityManagerInterface $entityManager,
                                PageBinderServiceInterface $pageBinderService,
                                LocaleBinderServiceInterface $localeBinderService,
                                CreateResponse $saveResponse)
    {
        $this->pageBinderService = $pageBinderService;
        $this->localeBinderService = $localeBinderService;
        $this->entityManager = $entityManager;
        $this->createResponse = $saveResponse;
    }

    /**
     * @param Product $productEntity
     * @param LocalizedInterface $localizedData
     * @return CreateResponse
     */
    public function save(Product $productEntity, LocalizedInterface $localizedData)
    {
        try {
            $this->entityManager->beginTransaction();

            $localizedEntity = new Product\Localized();
            $productEntity->setEnabled(1);

            $localizedEntity->setProduct($productEntity);

            $response = $this->localeBinderService
                             ->bind($localizedData, $localizedEntity);

            if ($response->isFailed()) {
                return $response;
            }

            $this->pageBinderService->bind($localizedData, $localizedEntity);
            $this->entityManager->persist($localizedEntity);

            $this->entityManager->flush();

            $this->createResponse->setResource($localizedEntity->getId());
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            $this->createResponse->error($e->getMessage())->failed();
            return $this->createResponse;
        }

        $this->createResponse->success();
        return $this->createResponse;
    }
}
