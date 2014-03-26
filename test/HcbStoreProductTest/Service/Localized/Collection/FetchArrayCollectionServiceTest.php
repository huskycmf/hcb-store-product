<?php
namespace HcbStoreProductTest\Service\Localized\Collection;

use Doctrine\ORM\Query;
use HcbStoreProduct\Service\Localized\Collection\FetchArrayCollectionService;
use Zend\Stdlib\Parameters;

class FetchArrayCollectionServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $entityManager;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $filtrationService;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $qb;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $repository;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $entityMock;

    /**
     * @var FetchArrayCollectionService
     */
    protected $fetcher;

    public function setUp()
    {
        $this->entityManager = $this->getMock('Doctrine\ORM\EntityManager', array(), array(), '', false);
        $this->filtrationService = $this->getMock('HcCore\Service\Filtration\Query\FiltrationServiceInterface');
        $this->repository = $this->getMock('Doctrine\ORM\EntityRepository', array(), array(), '', false);
        $this->qb = $this->getMock('Doctrine\ORM\QueryBuilder', array(), array(), '', false);

        $this->fetcher = new FetchArrayCollectionService($this->entityManager, $this->filtrationService);

        $this->repository->expects($this->once())
             ->method('createQueryBuilder')
             ->will($this->returnValue($this->qb));

        $this->qb->expects($this->once())->method('join')->will($this->returnSelf());
        $this->qb->expects($this->once())->method('where');

        $this->entityManager->expects($this->once())
             ->method('getRepository')
             ->will($this->returnValue($this->repository));

        $this->entityMock = $this->getMock('HcbStoreProduct\Entity\Product');
    }

    public function testFetchWithoutParamsArrayResultReturned()
    {
        $query = $this->getMockForAbstractClass('Doctrine\ORM\AbstractQuery',
                                                array(), '', false, false, true,
                                                array('getResult'));

        $query->expects($this->once())->method('getResult')->will($this->returnValue(array()));
        $this->qb->expects($this->once())->method('getQuery')->will($this->returnValue($query));

        $this->assertInstanceOf('Doctrine\Common\Collections\ArrayCollection',
                                $this->fetcher->fetch($this->entityMock));
    }

    public function testFetchWithParams()
    {
        $query = $this->getMockForAbstractClass('Doctrine\ORM\AbstractQuery',
            array(), '', false, false, true,
            array('getResult'));

        $params = new Parameters(array('param'=>'value'));

        $query->expects($this->once())->method('getResult')->will($this->returnValue(array()));

        $this->filtrationService->expects($this->once())->method('apply')->will($this->returnValue($this->qb));
        $this->qb->expects($this->once())->method('getQuery')->will($this->returnValue($query));

        $this->assertInstanceOf('Doctrine\Common\Collections\ArrayCollection',
                                $this->fetcher->fetch($this->entityMock, $params));
    }
}
