<?php
namespace HcbStoreProduct\Service\Localized;

use HcBackend\Service\PageBinderServiceInterface;
use HcBackend\Service\ImageBinderServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use HcbStoreProduct\Data\LocalizedInterface;
use HcbStoreProduct\Entity\Product\Localized;
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
     * @param EntityManagerInterface $entityManager
     * @param PageBinderServiceInterface $pageBinderService
     * @param ResponseInterface $saveResponse
     */
    public function __construct(EntityManagerInterface $entityManager,
                                PageBinderServiceInterface $pageBinderService,
                                ResponseInterface $saveResponse)
    {
        $this->pageBinderService = $pageBinderService;
        $this->entityManager = $entityManager;
        $this->saveResponse = $saveResponse;
    }

    /**
     * @param \HcbStoreProduct\Entity\Product\Localized $productLocalizedEntity
     * @param LocalizedInterface $localizedData
     * @return ResponseInterface
     */
    public function update(Localized $productLocalizedEntity, LocalizedInterface $localizedData)
    {
        try {
            $this->entityManager->beginTransaction();

            $this->pageBinderService->bind($localizedData, $productLocalizedEntity);

            $productLocalizedEntity->setTitle($localizedData->getTitle());
            $productLocalizedEntity->setDescription($localizedData->getDescription());

            $productLocalizedEntity->getProduct()->setPrice($localizedData->getPrice());
            $productLocalizedEntity->getProduct()->setPriceDeal($localizedData->getPriceDeal());

            $productLocalizedEntity->setShortDescription($localizedData->getShortDescription());
            $productLocalizedEntity->setExtraDescription($localizedData->getExtraDescription());
            $productLocalizedEntity->getProduct()->setStatus($localizedData->getStatus());

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
