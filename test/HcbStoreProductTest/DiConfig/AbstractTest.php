<?php
namespace HcbStoreProductTest\DiConfig;

use Zend\Di\Config;
use Zend\Di\Di;

abstract class AbstractTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Di
     */
    protected $di;

    /**
     * Prepare the objects to be tested.
     */
    protected function setUp()
    {
        $diConfig = new Config(array_merge_recursive((new \HcCore\Module())->getConfig()['di'],
                                                     (new \HcBackend\Module())->getConfig()['di'],
                                                     (new \HcbStoreProduct\Module())->getConfig()['di']));

        $this->di = new Di(null, null, $diConfig);

        $this->di
            ->instanceManager()
            ->addSharedInstance($this->di, 'Zend\Di\Di');

        $this->di
             ->instanceManager()
             ->addSharedInstance($this->getMock('Doctrine\ORM\EntityManager', array(), array(), '', false),
                                 'Doctrine\ORM\EntityManager');


    }
}
