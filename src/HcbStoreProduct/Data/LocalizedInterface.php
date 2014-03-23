<?php
namespace HcbStoreProduct\Data;

use HcBackend\Data\ImageInterface;
use HcBackend\Data\PageInterface;
use HcBackend\Data\LangInterface;

interface LocalizedInterface extends PageInterface, LangInterface, ImageInterface
{
    /**
     * @return string
     */
    public function getContent();
}
