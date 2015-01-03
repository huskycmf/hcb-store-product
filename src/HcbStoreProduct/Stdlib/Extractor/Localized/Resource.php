<?php
namespace HcbStoreProduct\Stdlib\Extractor\Localized;

use Doctrine\ORM\EntityManagerInterface;
use HcBackend\Service\Alias\DetectAlias;
use Zf2Libs\Stdlib\Extractor\ExtractorInterface;
use Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException;
use HcbStoreProduct\Entity\Product\Localized as ProductLocalizedEntity;
use HcBackend\Stdlib\Extractor\Page\Extractor as PageExtractor;

class Resource implements ExtractorInterface
{
    /**
     * @var PageExtractor
     */
    protected  $pageExtractor;

    /**
     * @var DetectAlias
     */
    protected $detectAlias;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param PageExtractor $pageExtractor
     */
    public function __construct(PageExtractor $pageExtractor,
                                DetectAlias $detectAlias,
                                EntityManagerInterface $entityManager)
    {
        $this->pageExtractor = $pageExtractor;
        $this->detectAlias = $detectAlias;
        $this->entityManager = $entityManager;
    }

    /**
     * Extract values from an object
     *
     * @param  ProductLocalizedEntity $productLocalized
     * @throws InvalidArgumentException
     * @return array
     */
    public function extract($productLocalized)
    {
        if (!$productLocalized instanceof ProductLocalizedEntity) {
            throw new InvalidArgumentException
                        ("Expected HcbStoreProduct\\Entity\\Product\\Localized object, invalid object given");
        }

        $createdTimestamp = $productLocalized->getProduct()->getCreatedTimestamp();
        if ($createdTimestamp) {
            $createdTimestamp = $createdTimestamp->format('Y-m-d H:i:s');
        }

        $updatedTimestamp = $productLocalized->getProduct()->getUpdatedTimestamp();
        if ($updatedTimestamp) {
            $updatedTimestamp = $updatedTimestamp->format('Y-m-d H:i:s');
        }

        $categoryRepository = $this->entityManager
                                   ->getRepository('HcbStoreProductCategory\Entity\Category');

        $qb = $categoryRepository->createQueryBuilder('c');
        /* @var $categoryEntity \HcbStoreProductCategory\Entity\Category */
        $categoryEntity = $qb->select()
                             ->join('c.product', 'p')
                             ->where('p = :product')
                             ->setParameter('product', $productLocalized->getProduct())
                             ->setMaxResults(1)
                             ->getQuery()
                             ->getOneOrNullResult();

        $categoryId = '';
        if (!is_null($categoryEntity)) {
            $categoryId = $categoryEntity->getId();
        }

        $aliasWireEntity = $this->detectAlias
                                ->detect($productLocalized->getProduct());

        $replaceProduct = $productLocalized->getProduct()
                                           ->getProduct();
        $characteristics = $productLocalized->getCharacteristic();
        $attributes = $productLocalized->getProduct()->getAttribute();

        $isEnabled = array();
        if ($productLocalized->getProduct()->getEnabled()) {
            $isEnabled[0] = 'on';
        }

        $isNew = array();
        if ($productLocalized->getProduct()->getIsNew()) {
            $isNew[0] = 'on';
        }

        $isWatched = array();
        $watchedRepository = $this->entityManager
            ->getRepository('HcbStoreProductWatched\Entity\Watched');

        $watchedEntity = $watchedRepository->createQueryBuilder('w')
                                           ->select()
                                           ->join('w.product', 'p')
                                           ->where('p = :product')
                                           ->setParameter('product',
                                                          $productLocalized->getProduct())
                                           ->setMaxResults(1)
                                           ->getQuery()
                                           ->getOneOrNullResult();
        if (!is_null($watchedEntity)) {
            $isWatched[0] = 'on';
        }

        $locale = $productLocalized->getLocale();

        $sellStrategyProductRepository = $this->entityManager
                                       ->getRepository
                                       ('HcbStoreSellStrategy\Entity\SellStrategy\Product');

        $qb = $sellStrategyProductRepository->createQueryBuilder('sp');
        $qb->select(array('sp'))
           ->join('sp.sellStrategy', 'ss')
           ->where('ss.name = :name')
           ->andWhere('sp.sellProduct = :product')
           ->setParameter('name', 'crosssell')
           ->setParameter('product', $productLocalized->getProduct());

        $crosssell = array();

        /* @var $sellProductEntity \HcbStoreSellStrategy\Entity\SellStrategy\Product */
        foreach ($qb->getQuery()->getResult() as $sellProductEntity) {
            $crosssell[] = (string)$sellProductEntity->getProduct()->getId();
        }


        $localData = array('locale'=>($locale ? $locale ->getLocale() : ''),
                           'alias'=>(is_null($aliasWireEntity) ? '' :
                                     $aliasWireEntity->getAlias()->getName()),
                           'category'=>$categoryId,
                           'title'=>$productLocalized->getTitle(),
                           'description'=>$productLocalized->getDescription(),
                           'shortDescription'=>$productLocalized->getShortDescription(),
                           'extraDescription'=>$productLocalized->getExtraDescription(),
                           'status' => $productLocalized->getProduct()->getStatus(),
                           'price' => $productLocalized->getProduct()->getPrice(),
                           'isNew' => $isNew,
                           'isEnabled' => $isEnabled,
                           'isWatched' => $isWatched,
                           'crosssell[]' => $crosssell,
                           'instruction' => $productLocalized->getProduct()
                                                             ->getFileInstruction(),
                           'characteristics[]'=>
                               $characteristics->map(function ($characteristic){return $characteristic->getName().":".$characteristic->getValue();})->toArray(),
                           'attributes[]'=>
                               $attributes->map(function ($attribute){return $attribute->getName();})->toArray(),
                           'replaceProduct' => (is_null($replaceProduct) ?
                                                null : $replaceProduct->getId()),
                           'priceDeal' => $productLocalized->getProduct()->getPriceDeal(),
                           'createdTimestamp'=>$createdTimestamp,
                           'updatedTimestamp'=>$updatedTimestamp);

        if ($productLocalized->getId()) {
            $localData['id']=$productLocalized->getId();
        }
        
        if (($pageEntity = $productLocalized->getPage())) {
            $localData = array_merge($localData, $this->pageExtractor->extract($pageEntity));
        }

        return $localData;
    }
}
