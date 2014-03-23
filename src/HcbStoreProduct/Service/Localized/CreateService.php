<?php
namespace HcbStoreProduct\Service\Locale;

use HcBackend\Service\PageBinderServiceInterface;
use HcBackend\Service\ImageBinderServiceInterface;
use HcbStoreProduct\Data\LocaleInterface;
use HcbStoreProduct\Entity\StaticPage;
use Doctrine\ORM\EntityManagerInterface;
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
     * @var ImageBinderServiceInterface
     */
    protected $imageBinderService;

    /**
     * @param EntityManagerInterface $entityManager
     * @param PageBinderServiceInterface $pageBinderService
     * @param ImageBinderServiceInterface $imageBinderService
     * @param CreateResponse $saveResponse
     */
    public function __construct(EntityManagerInterface $entityManager,
                                PageBinderServiceInterface $pageBinderService,
                                ImageBinderServiceInterface $imageBinderService,
                                CreateResponse $saveResponse)
    {
        $this->pageBinderService = $pageBinderService;
        $this->imageBinderService = $imageBinderService;
        $this->entityManager = $entityManager;
        $this->createResponse = $saveResponse;
    }

    /**
     * @param StaticPage $staticPageEntity
     * @param LocaleInterface $localeData
     * @return CreateResponse
     */
    public function save(StaticPage $staticPageEntity, LocaleInterface $localeData)
    {
        try {
            $this->entityManager->beginTransaction();

            $localeEntity = new StaticPage\Locale();
            $staticPageEntity->setEnabled(1);

            $localeEntity->setStaticPage($staticPageEntity);
            $localeEntity->setLang($localeData->getLang());

            $this->imageBinderService->bind($localeData, $localeEntity);
            $this->pageBinderService->bind($localeData, $localeEntity);

            $this->entityManager->persist($localeEntity);

            $localeEntity->setContent($localeData->getContent());

            $this->entityManager->flush();

            $this->createResponse->setResource($localeEntity->getId());

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
