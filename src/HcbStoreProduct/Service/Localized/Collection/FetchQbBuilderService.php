<?php
namespace HcbStoreProduct\Service\Localized\Collection;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use HcbStoreProduct\Entity\Product as ProductEntity;
use HcCore\Service\Fetch\Paginator\ArrayCollection\ResourceDataServiceInterface;
use Doctrine\ORM\QueryBuilder;
use HcCore\Service\Filtration\Query\FiltrationServiceInterface;
use HcbStoreProduct\Service\Exception\InvalidResourceException;
use Zend\Stdlib\Parameters;

class FetchQbBuilderService implements ResourceDataServiceInterface
{
    /**
     * @var FiltrationServiceInterface
     */
    protected $filtrationService;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     * @param FiltrationServiceInterface $filtrationService
     */
    public function __construct(EntityManagerInterface $entityManager,
                                FiltrationServiceInterface $filtrationService)
    {
        $this->entityManager = $entityManager;
        $this->filtrationService = $filtrationService;
    }

    /**
     * @param ProductEntity $productEntity
     * @param Parameters $params
     * @return ArrayCollection
     * @throws InvalidResourceException
     */
    public function fetch($productEntity, Parameters $params = null)
    {
        if (!$productEntity instanceof ProductEntity) {
            throw new InvalidResourceException('productEntity must be compatible with type HcbStoreProduct\Entity\Product');
        }

        /* @var $localizedRepository \Doctrine\ORM\EntityRepository */
        $localizedRepository = $this->entityManager->getRepository('HcbStoreProduct\Entity\Product\Localized');
        $qb = $localizedRepository->createQueryBuilder('l');

        $qb->join('l.locale', 'locale')
           ->where('l.product = :product');

        $qb->setParameter('product', $productEntity);

        if (is_null($params)) {
            return $qb->getQuery()
                      ->getArrayResult();
        }

        return new ArrayCollection($this->filtrationService->apply($params, $qb, 'l', array('lang'=>'locale.locale'))
                                        ->getQuery()->getResult());
    }
}
