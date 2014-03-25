<?php
namespace HcbStoreProduct\Stdlib\Extractor;

use Zf2Libs\Stdlib\Extractor\ExtractorInterface;
use Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException;

use HcbStoreProduct\Entity\Product as ProductEntity;
use HcbStoreProduct\Entity\Product\Localized as ProductLocalizedEntity;

class Resource implements ExtractorInterface
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

        /* @var $localizedEntity ProductLocalizedEntity */
        $localizedEntity = $product->getLocalized()->current();
        $updatedTimestamp = $localizedEntity->getUpdatedTimestamp();
        if (is_null($updatedTimestamp)) {
            $updatedTimestamp = $localizedEntity->getCreatedTimestamp()->format('Y-m-d H:i:s');
        } else {
            $updatedTimestamp = $updatedTimestamp->format('Y-m-d H:i:s');
        }

        $page = $localizedEntity->getPage();

        return array('id'=>$localizedEntity->getId(),
                     'url'=>(is_null($page) ? '' : $page->getUrl()),
                     'timestamp'=>$updatedTimestamp);
    }
}
