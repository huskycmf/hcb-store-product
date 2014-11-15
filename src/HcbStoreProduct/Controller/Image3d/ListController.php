<?php
namespace HcbStoreProduct\Controller\Image3d;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use HcCore\Controller\Common\Collection\AbstractResourceController;
use HcCore\Service\FetchServiceInterface;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\JsonModel;
use Zf2Libs\Paginator\ViewModel\JsonModelInterface;

class ListController extends AbstractResourceController
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var JsonModelInterface
     */
    protected $viewModel;

    /**
     * @param FetchServiceInterface $fetchService
     * @param JsonModelInterface $viewModel
     * @param EntityManager $entityManager
     */
    public function __construct(FetchServiceInterface $fetchService,
                                EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct($fetchService);
    }

    /* (non-PHPdoc)
     * @see Zend\Mvc\Controller.AbstractActionController::onDispatch()
     */
    public function onDispatch(MvcEvent $e)
    {
        /* @var $productEntity \HcbStoreProduct\Entity\Product */
        $productEntity = $this->getResourceEntity();

        $result = new JsonModel();

        $extractor = new DoctrineObject($this->entityManager, true);

        $image3d = $productEntity->getImage3d();
        if (!is_null($image3d)) {
            $image = $extractor->extract($image3d);
            $image['path'] = $image['httpPath'];
            $result->setVariable(0, $image);
        }

        $e->setResult($result);
    }
}
