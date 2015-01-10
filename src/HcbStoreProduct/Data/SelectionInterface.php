<?php
namespace HcbStoreProduct\Data;

use HcBackend\Data\ImageInterface;
use HcBackend\Data\PageInterface;
use HcbStoreSellStrategy\Data\Product\CrosssellInterface;
use HcCore\Data\LocaleInterface;

interface SelectionInterface extends ImageInterface
{
    /**
     * @return string
     */
    public function getPrice();

    /**
     * @return array
     */
    public function getProducts();
}
