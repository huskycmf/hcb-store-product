<?php
namespace HcbStoreProduct\Service\Localized\Collection;

use Doctrine\Common\Collections\ArrayCollection;
use HcbStoreProduct\Entity\Product as ProductEntity;
use HcCore\Service\Fetch\Paginator\ArrayCollection\ResourceDataServiceInterface;
use Doctrine\ORM\QueryBuilder;
use HcCore\Service\Filtration\Collection\FiltrationServiceInterface;
use HcbStoreProduct\Service\Exception\InvalidResourceException;
use Zend\Stdlib\Parameters;

class FetchQbBuilderService implements ResourceDataServiceInterface
{
    /**
     * @var FiltrationServiceInterface
     */
    protected $filtrationService;

    /**
     * @param FiltrationServiceInterface $filtrationService
     */
    public function __construct(FiltrationServiceInterface $filtrationService)
    {
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

        $collection = $productEntity->getLocalized();
        $arrayCollection = new ArrayCollection($collection->toArray());
        if (is_null($params)) {
            return $arrayCollection;
        }

        return $this->filtrationService->apply($params, $arrayCollection);
    }
}
