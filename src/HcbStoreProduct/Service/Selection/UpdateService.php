<?php
namespace HcbStoreProduct\Service\Selection;

use Doctrine\ORM\EntityManagerInterface;
use HcbStoreProduct\Data\SelectionInterface;
use HcbStoreProduct\Entity\Product;
use HcCore\Entity\EntityInterface;
use HcbStoreProduct\Stdlib\Service\Response\CreateResponse;
use HcCore\Service\ResourceCommandInterface;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;

class UpdateService implements ResourceCommandInterface
{
    /**
     * @var SelectionInterface
     */
    protected $selectionData;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @param EntityManagerInterface $entityManager
     * @param SelectionInterface $selectionData
     * @param Response $saveResponse
     */
    public function __construct(EntityManagerInterface $entityManager,
                                SelectionInterface $selectionData,
                                Response $saveResponse)
    {
        $this->entityManager = $entityManager;
        $this->response = $saveResponse;
        $this->selectionData = $selectionData;
    }

    /**
     * @param Product\Selection $selectionEntity
     * @return CreateResponse
     */
    public function execute(EntityInterface $selectionEntity)
    {
        try {
            $this->entityManager->beginTransaction();

            $selectionEntity->setPrice($this->selectionData->getPrice());

            $selectionEntity->getProduct()->clear();
            foreach ($this->selectionData->getProducts() as $productId) {
                $selectionEntity->addProduct($this->entityManager
                                                  ->getReference('HcbStoreProduct\Entity\Product',
                                                                 $productId));
            }

            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            $this->response->error($e->getMessage())->failed();
            return $this->response;
        }

        $this->response->success();
        return $this->response;
    }
}
