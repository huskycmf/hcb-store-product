<?php
namespace HcbStoreProductTest\Stdlib\Extractor;


use Doctrine\Common\Collections\ArrayCollection;
use HcbStoreProduct\Stdlib\Extractor\Resource as ResourceExtractor;
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

    public function setUp()
    {
        $this->extractor = new ResourceExtractor();
        $this->productMock = $this->getMock('HcbStoreProduct\Entity\Product');
        $this->localizedMock = $this->getMock('HcbStoreProduct\Entity\Product\Localized');

        $this->localizedMock->expects($this->once())->method('getId')->will($this->returnValue(1));

        $arrayCollection = new ArrayCollection(array($this->localizedMock));

        $this->productMock->expects($this->once())->method('getLocalized')
             ->will($this->returnValue($arrayCollection));
    }

    public function testExtractingDataSuccess()
    {
        $pageMock = $this->getMock('HcbStoreProduct\Entity\Product\Localized\Page');

        $dateTime = new \DateTime();

        $this->localizedMock->expects($this->once())
             ->method('getCreatedTimestamp')
             ->will($this->returnValue($dateTime));

        $this->localizedMock->expects($this->once())->method('getPage')
             ->will($this->returnValue($pageMock));

        $pageMock->expects($this->once())->method('getUrl')->will($this->returnValue('/test/url'));

        $this->assertEquals(array('id'=>1,
                                  'url'=>'/test/url',
                                  'timestamp'=>$dateTime->format('Y-m-d H:i:s')),
                            $this->extractor->extract($this->productMock));
    }

    public function testExtractingDataWithoutPageSuccess()
    {
        $dateTime = new \DateTime();

        $this->localizedMock->expects($this->once())
            ->method('getCreatedTimestamp')
            ->will($this->returnValue($dateTime));

        $this->assertEquals(array('id'=>1,
                                  'url'=>'',
                                  'timestamp'=>$dateTime->format('Y-m-d H:i:s')),
                            $this->extractor->extract($this->productMock));
    }

    public function testExtractingDataWithUpdatedTimestampSuccess()
    {
        $dateTime = new \DateTime();

        $this->localizedMock->expects($this->once())
             ->method('getUpdatedTimestamp')
             ->will($this->returnValue($dateTime));

        $this->assertEquals(array('id'=>1,
                                  'url'=>'',
                                  'timestamp'=>$dateTime->format('Y-m-d H:i:s')),
                            $this->extractor->extract($this->productMock));
    }
}
