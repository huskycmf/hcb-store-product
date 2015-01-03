<?php
namespace HcbStoreProduct\Data;

use HcBackend\Data\ImageInterface;
use HcBackend\Data\PageInterface;
use HcbStoreSellStrategy\Data\Product\CrosssellInterface;
use HcCore\Data\LocaleInterface;

interface LocalizedInterface extends PageInterface,
                                     ImageInterface,
                                     LocaleInterface,
                                     CharacteristicInterface,
                                     CrosssellInterface,
                                     AttributeInterface
{
    /**
     * @return string
     */
    public function getDescription();

    /**
     * @return string
     */
    public function getInstruction();

    /**
     * @return boolean
     */
    public function isNew();

    /**
     * @return boolean
     */
    public function isWatched();

    /**
     * @return boolean
     */
    public function isEnabled();

    /**
     * @return string
     */
    public function getShortDescription();

    /**
     * @return Product
     */
    public function getProductData();

    /**
     * @return number
     */
    public function getReplaceProductId();

    /**
     * @return number
     */
    public function getCategoryId();

    /**
     * @return string
     */
    public function getExtraDescription();

    /**
     * @return number
     */
    public function getStatus();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return number
     */
    public function getPrice();

    /**
     * @return number
     */
    public function getPriceDeal();
}
