<?php
namespace HcbStoreProduct\Stdlib\Extractor\Localized;

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
     * @param PageExtractor $pageExtractor
     */
    public function __construct(PageExtractor $pageExtractor,
                                DetectAlias $detectAlias)
    {
        $this->pageExtractor = $pageExtractor;
        $this->detectAlias = $detectAlias;
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

        $aliasWireEntity = $this->detectAlias
                                ->detect($productLocalized->getProduct());

        $replaceProduct = $productLocalized->getProduct()
                                           ->getProduct();
        $characteristics = $productLocalized->getCharacteristic();
        $attributes = $productLocalized->getProduct()->getAttribute();
//        \Zf2Libs\Debug\Utility::dump( $attributes->count() );

        $localData = array('id'=>$productLocalized->getId(),
                           'locale'=>$productLocalized->getLocale()->getLocale(),
                           'alias'=>(is_null($aliasWireEntity) ? '' :
                                     $aliasWireEntity->getAlias()->getName()),
                           'title'=>$productLocalized->getTitle(),
                           'description'=>$productLocalized->getDescription(),
                           'shortDescription'=>$productLocalized->getShortDescription(),
                           'extraDescription'=>$productLocalized->getExtraDescription(),
                           'status' => $productLocalized->getProduct()->getStatus(),
                           'price' => $productLocalized->getProduct()->getPrice(),
                           'characteristics[]'=>
                               $characteristics->map(function ($characteristic){return $characteristic->getName().":".$characteristic->getValue();})->toArray(),
                           'attributes[]'=>
                               $attributes->map(function ($attribute){return $attribute->getName();})->toArray(),
                           'replaceProduct' => (is_null($replaceProduct) ?
                                                null : $replaceProduct->getId()),
                           'priceDeal' => $productLocalized->getProduct()->getPriceDeal(),
                           'createdTimestamp'=>$createdTimestamp,
                           'updatedTimestamp'=>$updatedTimestamp);

        if (($pageEntity = $productLocalized->getPage())) {
            $localData = array_merge($localData, $this->pageExtractor->extract($pageEntity));
        }

        return $localData;
    }
}
