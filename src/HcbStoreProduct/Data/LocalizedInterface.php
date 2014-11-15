<?php
namespace HcbStoreProduct\Data;

use HcBackend\Data\ImageInterface;
use HcBackend\Data\PageInterface;
use HcCore\Data\LocaleInterface;

interface LocalizedInterface extends PageInterface, ImageInterface, LocaleInterface
{
    /**
     * @return string
     */
    public function getDescription();

    /**
     * @return string
     */
    public function getShortDescription();

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

    /**
     * @return \Zf2FileUploader\Resource\Persisted\ImageResourceInterface
     */
    public function getThumbnail();

    /**
     * @return \Zf2FileUploader\Resource\Persisted\ImageResourceInterface
     */
    public function getImage3d();
}
