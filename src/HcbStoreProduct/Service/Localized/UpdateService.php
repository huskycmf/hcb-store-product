<?php
namespace HcbStoreProduct\Service\Locale;

use HcBackend\Service\PageBinderServiceInterface;
use HcBackend\Service\ImageBinderServiceInterface;
use HcbStoreProduct\Data\LocaleInterface;
use Doctrine\ORM\EntityManagerInterface;
use HcbStoreProduct\Entity\StaticPage;
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
     * @var ImageBinderServiceInterface
     */
    protected $imageBinderService;

    /**
     * @param EntityManagerInterface $entityManager
     * @param PageBinderServiceInterface $pageBinderService
     * @param \HcBackend\Service\ImageBinderServiceInterface $imageBinderService
     * @param ResponseInterface $saveResponse
     */
    public function __construct(EntityManagerInterface $entityManager,
                                PageBinderServiceInterface $pageBinderService,
                                ImageBinderServiceInterface $imageBinderService,
                                ResponseInterface $saveResponse)
    {
        $this->pageBinderService = $pageBinderService;
        $this->imageBinderService = $imageBinderService;
        $this->entityManager = $entityManager;
        $this->saveResponse = $saveResponse;
    }

    /**
     * @param \HcbStoreProduct\Entity\StaticPage\Locale $localeEntity
     * @param LocaleInterface $localeData
     * @internal param \HcbStoreProduct\Entity\StaticPage $postEntity
     * @return ResponseMessagesInterface
     */
    public function update(StaticPage\Locale $localeEntity, LocaleInterface $localeData)
    {
        try {
            $this->entityManager->beginTransaction();

            $this->imageBinderService->bind($localeData, $localeEntity);
            $this->pageBinderService->bind($localeData, $localeEntity);

            $this->entityManager->persist($localeEntity);

            $localeEntity->setContent($localeData->getContent());

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
