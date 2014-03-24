<?php
namespace HcbStoreProductTest\Data;

use HcbStoreProduct\Data\Localized;
use HcbStoreProduct\Module;
use Zend\Di\Config;
use Zend\Di\Di;

class LocalizedDataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $requestParams;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $request;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $dataExtractor;

    /**
     * Prepare the objects to be tested.
     */
    protected function setUp()
    {
        $this->request = $this->getMock('Zend\Http\PhpEnvironment\Request');
        $this->requestParams = $this->getMock('Zend\Stdlib\Parameters');

        $this->dataExtractor = $this->getMock('HcCore\Stdlib\Extractor\Request\Payload\Extractor',
                                              array(), array(), '', false);

        $this->request->expects($this->any())
             ->method('getPost')
             ->will($this->returnValue($this->requestParams));
    }

    public function testInit()
    {
        $di = new Di();

        $this->dataExtractor->expects($this->once())
             ->method('extract')->will($this->returnValue(
                                         array('locale' => 'ru')
                                      ));

        $data = new Localized($this->request, $this->dataExtractor, $di);

        $this->assertTrue($data->isValid());
        $this->assertEquals('ru', $data->getLocale());
    }
}
