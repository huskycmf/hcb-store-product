<?php
namespace HcbStoreProduct\Stdlib\Extractor\Selection;

use Doctrine\ORM\EntityManager;
use Zf2Libs\Stdlib\Extractor\ExtractorInterface;
use Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException;

use HcbStoreProduct\Entity\Product\Selection as SelectionEntity;

class Resource implements ExtractorInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @param DetectAlias $detectAlias
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Extract values from an object
     *
     * @param  SelectionEntity $selectionEntity
     * @throws \Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException
     * @return array
     */
    public function extract($selectionEntity)
    {
        if (!$selectionEntity instanceof SelectionEntity) {
            throw new InvalidArgumentException("Expected HcbStoreProduct\\Entity\\Product\\Selection object, invalid object given");
        }

        /* @var $selectionEntity SelectionEntity */
        $title = '__EMPTY__';
        $products = $selectionEntity->getProduct();
        $productIds = array();
        if ($products->count()) {
            $titles = array();
            foreach ($products as $productEntity) {
                $titles[] = $productEntity->getLocalized()->current()->getTitle();
                $productIds[] = $productEntity->getId();
            }
            $title = join(' + ', $titles);
        }

        return array('id'=>$selectionEntity->getId(),
                     'title'=>$title,
                     'price'=>$selectionEntity->getPrice(),
                     'products[]'=>$productIds);
    }
}
