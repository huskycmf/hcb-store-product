<?php
namespace HcbStoreProduct\Controller\Images;

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

        $iter = 0;
        /* @var $image \HcbStoreProduct\Entity\Product\Image */
        foreach ($productEntity->getProductImage() as $k=>$image) {
            if ($image->getIsPreview() === true) continue;
            $image = $extractor->extract($image->getImage());
            $image['path'] = $image['httpPath'];
            $image['id'] = $image['token'];
            $result->setVariable($iter, $image);
            $iter++;
        }

        $e->setResult($result);
    }
}
