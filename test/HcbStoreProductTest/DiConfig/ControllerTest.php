<?php
namespace HcbStoreProductTest\DiConfig;

class ControllerTest extends AbstractTest
{
    public function testListController()
    {
        $this->assertInstanceOf('HcCore\Controller\Common\Rest\Collection\ListController',
                                    $this->di->get('HcbStoreProduct-Controller-Collection-List'));
    }

    public function testListLocalizedController()
    {
        $this->assertInstanceOf('HcCore\Controller\Common\Rest\Collection\ResourceListController',
                                    $this->di->get('HcbStoreProduct-Controller-Localized-Collection-List'));
    }

    public function testCreateController()
    {
        $this->assertInstanceOf('HcCore\Controller\Common\Rest\Collection\DataController',
                                    $this->di->get('HcbStoreProduct-Controller-Create'));
    }

    public function testLocalizedUpdateController()
    {
        $this->assertInstanceOf('HcCore\Controller\Common\Rest\Collection\ResourceDataController',
                                $this->di->get('HcbStoreProduct-Controller-Localized-Update'));
    }
}
