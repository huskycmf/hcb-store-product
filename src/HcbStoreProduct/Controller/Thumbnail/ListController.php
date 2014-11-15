<?php
namespace HcbStoreProduct\Controller\Thumbnail;

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

        /* @var $image \HcbStoreProduct\Entity\Product\Image */
        foreach ($productEntity->getImage() as $k=>$image) {
            if ($image->getIsPreview() != 1) {
                continue;
            }
            $image = $extractor->extract($image->getImage());
            $image['path'] = $image['httpPath'];
            $result->setVariable($k, $image);
        }

        $e->setResult($result);
    }
}
