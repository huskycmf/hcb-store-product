<?php
namespace HcbStoreProduct\Stdlib\Extractor;

use Doctrine\ORM\EntityManager;
use HcBackend\Service\Alias\DetectAlias;
use Zf2Libs\Stdlib\Extractor\ExtractorInterface;
use Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException;

use HcbStoreProduct\Entity\Product as ProductEntity;
use HcbStoreProduct\Entity\Product\Localized as ProductLocalizedEntity;

class Resource implements ExtractorInterface
{
    /**
     * @var DetectAlias
     */
    protected $detectAlias;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @param DetectAlias $detectAlias
     * @param EntityManager $entityManager
     */
    public function __construct(DetectAlias $detectAlias,
                                EntityManager $entityManager)
    {
        $this->detectAlias = $detectAlias;
        $this->entityManager = $entityManager;
    }

    /**
     * Extract values from an object
     *
     * @param  ProductEntity $product
     * @throws \Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException
     * @return array
     */
    public function extract($product)
    {
        if (!$product instanceof ProductEntity) {
            throw new InvalidArgumentException("Expected HcbStoreProduct\\Entity\\Product object, invalid object given");
        }

        /* @var $localizedEntity ProductLocalizedEntity */
        $localizedEntity = $product->getLocalized()->current();
        $title = '__EMPTY__';
        if (!empty($localizedEntity)) {
            $title = $localizedEntity->getTitle();
        }

        $updatedTimestamp = $product->getUpdatedTimestamp();
        if (is_null($updatedTimestamp)) {
            $updatedTimestamp = $product->getCreatedTimestamp()->format('Y-m-d H:i:s');
        } else {
            $updatedTimestamp = $updatedTimestamp->format('Y-m-d H:i:s');
        }

        $categoryRepository = $this->entityManager
                                   ->getRepository('HcbStoreProductCategory\Entity\Category');

        $qb = $categoryRepository->createQueryBuilder('c');
        /* @var $categoryEntity \HcbStoreProductCategory\Entity\Category */
        $categoryEntity = $qb->select()
                             ->join('c.product', 'p')
                             ->where('p = :product')
                             ->setParameter('product', $product)
                             ->setMaxResults(1)
                             ->getQuery()
                             ->getOneOrNullResult();

        $categoryName = '';
        if (!is_null($categoryEntity)) {
            $categoryName = $categoryEntity->getLocalized()->current()->getTitle();
        }

        return array('id'=>$product->getId(),
                     'name'=>$title,
                     'category'=>$categoryName,
                     'timestamp'=>$updatedTimestamp);
    }
}
