<?php
namespace HcbStoreProduct\Stdlib\Extractor;

use HcBackend\Service\Alias\DetectAlias;
use Zf2Libs\Stdlib\Extractor\ExtractorInterface;
use Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException;

use HcbStoreProduct\Entity\Product as ProductEntity;
use HcbStoreProduct\Entity\Product\Localized as ProductLocalizedEntity;

class Resource implements ExtractorInterface
{
    /**
     * @var DetectAlias
     */
    protected $detectAlias;

    /**
     * @param DetectAlias $detectAlias
     */
    public function __construct(DetectAlias $detectAlias)
    {
        $this->detectAlias = $detectAlias;
    }

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
        $updatedTimestamp = $product->getUpdatedTimestamp();
        if (is_null($updatedTimestamp)) {
            $updatedTimestamp = $product->getCreatedTimestamp()->format('Y-m-d H:i:s');
        } else {
            $updatedTimestamp = $updatedTimestamp->format('Y-m-d H:i:s');
        }

        $aliasEntity = $this->detectAlias->detect($localizedEntity->getProduct());
        return array('id'=>$localizedEntity->getId(),
                     'alias'=>(is_null($aliasEntity) ? '' : $aliasEntity->getAlias()->getName()),
                     'timestamp'=>$updatedTimestamp);
    }
}
