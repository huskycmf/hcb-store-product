<?php
namespace HcbStoreProduct\Stdlib\Extractor;

use Zf2Libs\Stdlib\Extractor\ExtractorInterface;
use Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException;

use HcbStoreProduct\Entity\Product as ProductEntity;
use HcbStoreProduct\Entity\Product\Localized as ProductLocalizedEntity;

class Collection implements ExtractorInterface
{
    /**
     * Extract values from an object
     *
     * @param  ProductEntity $product
     * @throws \Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException
     * @return array
     */
    public function extract($product)
    {
        if (!$product instanceof ProductEntity) {
            throw new InvalidArgumentException("Expected HcbStoreProduct\\Entity\\Product object, invalid object given");
        }

        /* @var $localeEntity ProductLocalizedEntity */
        $localeEntity = $product->getLocale()->current();
        $updatedTimestamp = $localeEntity->getUpdatedTimestamp();
        if (is_null($updatedTimestamp)) {
            $updatedTimestamp = $localeEntity->getCreatedTimestamp()->format('Y-m-d H:i:s');
        } else {
            $updatedTimestamp = $updatedTimestamp->format('Y-m-d H:i:s');
        }

        return array('id'=>$localeEntity->getId(),
                     'url'=>$localeEntity->getPage()->getUrl(),
                     'timestamp'=>$updatedTimestamp);
    }
}
