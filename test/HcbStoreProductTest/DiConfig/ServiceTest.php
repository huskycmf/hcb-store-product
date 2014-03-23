<?php
namespace HcbStoreProductTest\DiConfig;

class ServiceTest extends AbstractTest
{
    public function testFetchQbBuilderService()
    {
        $this->assertInstanceOf('HcbStoreProduct\Service\Collection\FetchQbBuilderService',
                                $this->di->get('HcbStoreProduct-Service-Collection-FetchQbBuilder'));
    }
}
