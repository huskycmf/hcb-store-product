<?php
namespace HcbStoreProduct\Service;

use HcCore\Service\FetchServiceInterface;
use Doctrine\ORM\EntityManagerInterface;

class FetchService implements FetchServiceInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param mixed $id
     * @return object
     */
    public function fetch($id)
    {
        return $this->entityManager->find('HcbStoreProduct\Entity\Product', $id);
    }
}
