<?php
namespace HcbStoreProductTest\Stdlib\Extractor\Localized;

use Doctrine\Common\Collections\ArrayCollection;
use HcbStoreProduct\Stdlib\Extractor\Localized\Resource as ResourceExtractor;
use HcbStoreProduct\Stdlib\Extractor\Localized\Resource;
use Zend\Di\Di;

class ResourceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ResourceExtractor
     */
    protected $extractor;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $productMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $localizedMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $pageExtractorMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $productExtractorMock;

    public function setUp()
    {
        $this->pageExtractorMock = $this->getMock('HcBackend\Stdlib\Extractor\Page\Extractor');

        $this->extractor = new Resource($this->pageExtractorMock);
        $this->localizedMock = $this->getMock('HcbStoreProduct\Entity\Product\Localized');

        $this->localizedMock->expects($this->once())
             ->method('getId')->will($this->returnValue(1));


        $localeMock = $this->getMock('HcCore\Entity\Locale');
        $localeMock->expects($this->once())
            ->method('getLang')
            ->will($this->returnValue('ru'));

        $this->localizedMock
            ->expects($this->once())
            ->method('getLocale')
            ->will($this->returnValue($localeMock));
    }

    public function testExtractingDataSuccess()
    {
        $this->pageExtractorMock->expects($this->once())
             ->method('extract')->will($this->returnValue(array('keywords'=>'test keywords')));

        $this->localizedMock->expects($this->once())
             ->method('getPage')
             ->will($this->returnValue($this->getMock('HcBackend\Entity\PageInterface')));

        $this->localizedMock->expects($this->once())
             ->method('getUpdatedTimestamp')
             ->will($this->returnValue(new \DateTime('2012-10-10 10:10:10')));

        $this->localizedMock->expects($this->once())
             ->method('getCreatedTimestamp')
             ->will($this->returnValue(new \DateTime('2012-09-10 10:10:10')));

        $this->assertEquals(array('id'=>1, 'lang'=>'ru',
                                  'keywords'=>'test keywords',
                                  'createdTimestamp'=>'2012-09-10 10:10:10',
                                  'updatedTimestamp'=>'2012-10-10 10:10:10'),
                            $this->extractor->extract($this->localizedMock));
    }

    public function testExtractingDataSuccessWithoutPage()
    {
        $this->pageExtractorMock->expects($this->any())->method('extract');

        $this->localizedMock->expects($this->once())
            ->method('getUpdatedTimestamp')
            ->will($this->returnValue(new \DateTime('2012-10-10 10:10:10')));

        $this->localizedMock->expects($this->once())
            ->method('getCreatedTimestamp')
            ->will($this->returnValue(new \DateTime('2012-09-10 10:10:10')));

        $this->assertEquals(array('id'=>1, 'lang'=>'ru',
                                  'createdTimestamp'=>'2012-09-10 10:10:10',
                                  'updatedTimestamp'=>'2012-10-10 10:10:10'),
                            $this->extractor->extract($this->localizedMock));
    }
}
