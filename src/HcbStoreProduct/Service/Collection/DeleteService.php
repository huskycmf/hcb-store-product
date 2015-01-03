<?php
namespace HcbStoreProduct\Service\Collection;

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
     * @param \HcCore\Data\Collection\Entities\ByIdsInterface $productsToDelete
     * @internal param \HcCore\Data\Collection\Entities\ByIdsInterface $clientsToBlock
     * @return Response
     */
    protected  function delete(ByIdsInterface $productsToDelete)
    {
        try {
            $this->entityManager->beginTransaction();
            $productEntities = $productsToDelete->getEntities();

            /* @var $productEntities ProductEntity[] */
            foreach ($productEntities as $productEntity) {
                $images = $productEntity->getImage();
                if (!is_null($images)) {
                    foreach ($images as $imageEntity) {
                        $this->imageRemover->remove($imageEntity);
                    }
                }
                if (!is_null($productEntity->getImage3d())) {
                    $this->imageRemover->remove($productEntity->getImage3d());
                }

                if (!is_null($productEntity->getFileInstruction())) {
                    @unlink(INDEX_DIR.$productEntity->getFileInstruction());
                }

                /* @var $localized ProductEntity\Localized[] */
                $localized = $productEntity->getLocalized();
                if (!is_null($localized)) {
                    foreach ($localized as $localizedEntity) {
                        $images = $localizedEntity->getImage();
                        if (!is_null($images)) {
                            foreach ($images as $imageEntity) {
                                $this->entityManager->remove($imageEntity);
                            }
                        }

                        $this->entityManager->remove($localizedEntity);
                        $productEntity->removeLocalized($localizedEntity);
                    }
                }
                $productEntity->setProduct(null);
                $this->entityManager->remove($productEntity);
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
