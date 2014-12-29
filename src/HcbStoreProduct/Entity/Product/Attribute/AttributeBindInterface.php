<?php
namespace HcbStoreProduct\Entity\Product\Attribute;

use HcbStoreProduct\Entity\Product;
use Doctrine\ORM\Mapping as ORM;

interface AttributeBindInterface
{
    /**
     * Add attribute
     *
     * @param \HcbStoreProduct\Entity\Product\Attribute $attribute
     * @return Product
     */
    public function addAttribute(\HcbStoreProduct\Entity\Product\Attribute $attribute);

    /**
     * Remove attribute
     *
     * @param \HcbStoreProduct\Entity\Product\Attribute $attribute
     */
    public function removeAttribute(\HcbStoreProduct\Entity\Product\Attribute $attribute);

    /**
     * Get attribute
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttribute();
}
