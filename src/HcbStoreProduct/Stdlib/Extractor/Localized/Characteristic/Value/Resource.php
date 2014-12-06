<?php
namespace HcbStoreProduct\Stdlib\Extractor\Localized\Characteristic\Value;

use Doctrine\ORM\EntityManager;
use HcBackend\Service\Alias\DetectAlias;
use Zf2Libs\Stdlib\Extractor\ExtractorInterface;
use Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException;
use HcbStoreProduct\Entity\Product\Localized\Characteristic as CharacteristicEntity;

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
     * @param  CharacteristicEntity $product
     * @throws \Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException
     * @return array
     */
    public function extract($characteristic)
    {
        if (!$characteristic instanceof CharacteristicEntity) {
            throw new InvalidArgumentException("Expected HcbStoreProduct\\Entity\\Product\\Localized\\Characteristic object, invalid object given");
        }

        return array('id'=>$characteristic->getId(),
                     'name'=>$characteristic->getName(),
                     'value'=>$characteristic->getValue());
    }
}
