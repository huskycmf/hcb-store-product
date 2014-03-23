<?php
namespace HcbStoreProduct\Service\Locale\Collection;

use Doctrine\Common\Collections\ArrayCollection;
use HcCore\Service\Fetch\Paginator\ArrayCollection\ResourceDataServiceInterface;
use Doctrine\ORM\QueryBuilder;
use HcCore\Service\Filtration\Collection\FiltrationServiceInterface;
use HcbStoreProduct\Entity\StaticPage;
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
     * @param StaticPage $staticPageEntity
     * @param Parameters $params
     * @return ArrayCollection
     * @throws InvalidResourceException
     */
    public function fetch($staticPageEntity, Parameters $params = null)
    {
        if (!$staticPageEntity instanceof StaticPage) {
            throw new InvalidResourceException('staticPageEntity must be compatible with type HcbStoreProduct\Entity\StaticPage');
        }

        $collection = $staticPageEntity->getLocales();
        $arrayCollection = new ArrayCollection($collection->toArray());
        if (is_null($params)) {
            return $arrayCollection;
        }

        return $this->filtrationService->apply($params, $arrayCollection);
    }
}
