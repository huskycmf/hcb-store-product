<?php
namespace HcbStoreProductTest\DiConfig;

class CommonTest extends AbstractTest
{
    public function testPaginatorViewModelJsonModelProduct()
    {
        $this->assertInstanceOf('Zf2Libs\Paginator\ViewModel\JsonModel',
                                $this->di->get('HcbStoreProduct-Paginator-ViewModel-JsonModel-Product'));
    }

    public function testPaginatorViewModelJsonModelLocalized()
    {
        $this->assertInstanceOf('Zf2Libs\Paginator\ViewModel\JsonModel',
                                $this->di->get('HcbStoreProduct-Paginator-ViewModel-JsonModel-Localized'));
    }

    public function testStdlibExtractorCollectionProduct()
    {
        $this->assertInstanceOf('HcbStoreProduct\Stdlib\Extractor\Collection\Product',
                                $this->di->get('HcbStoreProduct-Stdlib-Extractor-Collection-Product'));
    }
}
