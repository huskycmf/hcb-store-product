<?php
namespace HcbStoreProduct\Data;

use HcBackend\Data\PageInterface;
use HcCore\Data\LocaleInterface;

interface LocalizedInterface extends PageInterface, LocaleInterface
{
    /**
     * @return string
     */
    public function getContent();
}
