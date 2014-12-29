<?php
namespace HcbStoreProduct\Stdlib\Extractor\Attribute;

use Doctrine\ORM\EntityManager;
use Zf2Libs\Stdlib\Extractor\ExtractorInterface;
use Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException;
use HcbStoreProduct\Entity\Product\Attribute as AttributeEntity;

class Resource implements ExtractorInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Extract values from an object
     *
     * @param  AttributeEntity $product
     * @throws \Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException
     * @return array
     */
    public function extract($attribute)
    {
        if (!$attribute instanceof AttributeEntity) {
            throw new InvalidArgumentException("Expected HcbStoreProduct\\Entity\\Product\\Attribute object, invalid object given");
        }

        return array('id'=>$attribute->getId(),
                     'name'=>$attribute->getName());
    }
}
