<?php
namespace HcBackend\Service;

use Doctrine\ORM\EntityManagerInterface;
use HcBackend\Data\ImageInterface;
use HcBackend\Entity\Image;
use HcBackend\Entity\ImageBindInterface;
use HcbStoreProduct\Data\LocalizedInterface;
use Zf2FileUploader\Resource\Handler\Remover\RemoverInterface;
use Zf2FileUploader\Service\Image\BindServiceInterface as BindServiceInterface;

class ImageBinderService
{
    /**
     * @var BindServiceInterface
     */
    protected $bindService;

    /**
     * @var RemoverInterface
     */
    protected $remover;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param BindServiceInterface $bindService
     * @param RemoverInterface $remover
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(BindServiceInterface $bindService,
                                RemoverInterface $remover,
                                EntityManagerInterface $entityManager)
    {
        $this->bindService = $bindService;
        $this->remover = $remover;
        $this->entityManager = $entityManager;
    }

    protected function bindImage3d()
    {

    }


    /**
     * @param LocalizedInterface $imageData
     * @param ImageBindInterface $imageBinder
     */
    public function bind(LocalizedInterface $data, ImageBindInterface $imageBinder)
    {
        $bindIds = array();

        /* @var $imageEntity Image */
        foreach ($imageBinder->getImage() as $imageEntity){
            $bindIds[$imageEntity->getId()] = $imageEntity;
        }

        foreach ($data->getResources() as $resource) {
            if (array_key_exists($resource->getEntity()->getId(), $bindIds)) {
                unset($bindIds[$resource->getEntity()->getId()]);
                continue;
            }
            $this->bindService->bind($resource, $imageBinder);
        }

        foreach ($bindIds as $imageEntity) {
            $this->remover->remove($imageEntity);
        }

        $this->entityManager->persist($imageBinder);
    }
}
