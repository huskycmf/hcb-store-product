<?php
namespace HcbStoreProduct\Service\Selection\Collection;

use HcbStoreProduct\Entity\Product\Selection as SelectionEntity;
use HcbStoreProduct\Entity\Product as ProductEntity;
use HcCore\Data\Collection\Entities\ByIdsInterface;
use HcCore\Service\CommandInterface;
use Doctrine\ORM\EntityManagerInterface;
use Zf2FileUploader\Resource\Handler\Remover\RemoverInterface;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;

class DeleteService implements CommandInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var ByIdsInterface
     */
    protected $deleteData;

    /**
     * @var RemoverInterface
     */
    protected $imageRemover;

    /**
     * @param EntityManagerInterface $entityManager
     * @param Response $response
     * @param RemoverInterface $imageRemover
     * @param ByIdsInterface $deleteData
     */
    public function __construct(EntityManagerInterface $entityManager,
                                Response $response,
                                RemoverInterface $imageRemover,
                                ByIdsInterface $deleteData)
    {
        $this->entityManager = $entityManager;
        $this->response = $response;
        $this->imageRemover = $imageRemover;
        $this->deleteData = $deleteData;
    }

    /**
     * @return Response
     */
    public function execute()
    {
        return $this->delete($this->deleteData);
    }

    /**
     * @param \HcCore\Data\Collection\Entities\ByIdsInterface $selectionsToDelete
     *
     * @return Response
     */
    protected  function delete(ByIdsInterface $selectionsToDelete)
    {
        try {
            $this->entityManager->beginTransaction();

            /* @var $selectionEntities SelectionEntity[] */
            $selectionEntities = $selectionsToDelete->getEntities();

            foreach ($selectionEntities as $selectionEntity) {
                $image = $selectionEntity->getImage();
                if (!is_null($image)) {
                    $this->imageRemover->remove($image);
                }
                $this->entityManager->remove($selectionEntity);
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
