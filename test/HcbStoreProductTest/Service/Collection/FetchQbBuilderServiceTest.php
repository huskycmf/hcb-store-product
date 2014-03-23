<?php
namespace HcbStoreProductTest\Service\Collection;

use HcbStoreProduct\Service\Collection\FetchQbBuilderService;

class FetchQbBuilderServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $entityManager;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $sortingService;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $qb;

    public function setUp()
    {
        $this->entityManager = $this->getMock('Doctrine\ORM\EntityManager', array(), array(), '', false);

        $this->sortingService = $this->getMock('HcCore\Service\Sorting\SortingServiceInterface');

        $repository = $this->getMock('Doctrine\ORM\EntityRepository', array(), array(), '', false);

        $this->qb = new \Doctrine\ORM\QueryBuilder($this->entityManager);
        $repository->expects($this->once())
            ->method('createQueryBuilder')
            ->will($this->returnValue($this->qb));

        $this->entityManager->expects($this->once())
            ->method('getRepository')
            ->will($this->returnValue($repository));
    }

    public function testFetchServiceQbBuilderWithParams()
    {
        $this->sortingService->expects($this->once())->method('apply')->will($this->returnValue($this->qb));
        $service = new FetchQbBuilderService($this->entityManager, $this->sortingService);
        $params = new \Zend\Stdlib\Parameters(array('sort'=>array('test_sort')));
        $this->assertEquals($this->qb, $service->fetch($params));
    }

    public function testFetchServiceQbBuilderWithoutParams()
    {
        $this->sortingService->expects($this->any())->method('apply');
        $service = new FetchQbBuilderService($this->entityManager, $this->sortingService);
        $this->assertEquals($this->qb, $service->fetch());
    }
}
