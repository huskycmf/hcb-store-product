<?php
namespace HcbStoreProduct\Stdlib\Extractor\Localized;

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
     * @param PageExtractor $pageExtractor
     */
    public function __construct(PageExtractor $pageExtractor)
    {
        $this->pageExtractor = $pageExtractor;
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
            throw new InvalidArgumentException("Expected HcbStoreProduct\\Entity\\Product\\Localized
                                                object, invalid object given");
        }

        $createdTimestamp = $productLocalized->getCreatedTimestamp();
        if ($createdTimestamp) {
            $createdTimestamp = $createdTimestamp->format('Y-m-d H:i:s');
        }

        $updatedTimestamp = $productLocalized->getUpdatedTimestamp();
        if ($updatedTimestamp) {
            $updatedTimestamp = $updatedTimestamp->format('Y-m-d H:i:s');
        }

        $localData = array('id'=>$productLocalized->getId(),
                           'locale'=>$productLocalized->getLocale()->getLocale(),
                           'createdTimestamp'=>$createdTimestamp,
                           'updatedTimestamp'=>$updatedTimestamp);

        if (($pageEntity = $productLocalized->getPage())) {
            $localData = array_merge($localData, $this->pageExtractor->extract($pageEntity));
        }

        return $localData;
    }
}
