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

    public function testStdlibExtractorResource()
    {
        $this->assertInstanceOf('HcbStoreProduct\Stdlib\Extractor\Resource',
                                $this->di->get('HcbStoreProduct-Stdlib-Extractor-Resource'));
    }

    public function testStdlibExtractorLocalizedResource()
    {
        $this->assertInstanceOf('HcbStoreProduct\Stdlib\Extractor\Localized\Resource',
                                $this->di->get('HcbStoreProduct-Stdlib-Extractor-Localized-Resource'));
    }
}
