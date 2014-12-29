<?php
namespace HcbStoreProduct\Service\Attribute;

use Doctrine\ORM\EntityManagerInterface;
use HcbStoreProduct\Data\AttributeInterface;
use HcbStoreProduct\Entity\Product\Attribute ;
use HcbStoreProduct\Entity\Product\Attribute\AttributeBindInterface;

class AttributeBinderService
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param AttributeInterface $attributeData
     * @param AttributeBindInterface $attributeBinder
     */
    public function bind(AttributeInterface $attributeData,
                         AttributeBindInterface $attributeBinder)
    {
        $attributeData = $attributeData->getAttribute();
        $currentAttributes = $attributeBinder->getAttribute();

        $currentAttributes->clear();
        if (empty($attributeData)) {
            return;
        }
        foreach ($attributeData as $attribute) {
            $attribute = trim($attribute);
            /* @var $attributeEntity \HcbStoreProduct\Entity\Product\Attribute */
            $attributeEntity = $this->entityManager
                                ->getRepository
                                    ('HcbStoreProduct\Entity\Product\Attribute')
                                ->findOneBy(array('name'=>$attribute));

            if (is_null($attributeEntity)) {
                continue;
            }
            $this->entityManager->persist($attributeBinder);
            $attributeBinder->addAttribute($attributeEntity);
        }
    }
}
