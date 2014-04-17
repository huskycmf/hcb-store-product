<?php
namespace HcbStoreProduct\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use HcBackend\Service\Alias\FetchLocalizedServiceInterface;

class FetchByAliasService implements FetchLocalizedServiceInterface
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
     * @param string $alias
     * @return \HcBackend\Entity\LocalizedInterface | null
     */
    public function fetch($alias)
    {
        /* @var $qb QueryBuilder */
        $qb = $this->entityManager
                   ->getRepository('HcbStoreProduct\Entity\Product\Alias')
                   ->createQueryBuilder('a');

        $qb->select(array('a'))
           ->join('a.alias', 'aa')
           ->join('a.product', 'ap')
           ->where('ap.enabled = 1')
           ->andWhere('aa.name = :alias')
           ->setParameter('alias', $alias);

        /* @var $aliasEntity \HcbStoreProduct\Entity\Product\Alias */
        $aliasEntity = $qb->getQuery()->getOneOrNullResult();

        if (is_null($aliasEntity)) {
            return null;
        }

        return $aliasEntity->getProduct();
    }
}
