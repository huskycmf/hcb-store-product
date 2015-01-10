<?php
namespace HcbStoreProduct\Service\Selection;

use Doctrine\ORM\EntityManagerInterface;
use HcbStoreProduct\Data\SelectionInterface;
use HcbStoreProduct\Entity\Product;
use HcCore\Service\CommandInterface;
use HcbStoreProduct\Stdlib\Service\Response\CreateResponse;

class CreateService implements CommandInterface
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
     * @var SelectionInterface
     */
    protected $selectionData;

    /**
     * @var UpdateService
     */
    protected $updateService;

    /**
     * @param EntityManagerInterface $entityManager
     * @param CreateResponse $createResponse
     */
    public function __construct(EntityManagerInterface $entityManager,
                                CreateResponse $createResponse,
                                SelectionInterface $selectionData,
                                UpdateService $updateService)
    {
        $this->entityManager = $entityManager;
        $this->createResponse = $createResponse;
        $this->updateService = $updateService;
        $this->selectionData = $selectionData;
    }

    /**
     * @return CreateResponse
     */
    public function execute()
    {
        try {
            $this->entityManager->beginTransaction();

            $selectionEntity = new Product\Selection();

            $this->updateService->execute($selectionEntity);

            $this->entityManager->persist($selectionEntity);

            $this->entityManager->flush();

            $this->createResponse->setResource($selectionEntity->getId());
            
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
