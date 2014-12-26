<?php
namespace HcbStoreProduct\Service\Localized\Characteristic;

use Doctrine\ORM\EntityManagerInterface;
use HcbStoreProduct\Data\CharacteristicInterface;
use HcbStoreProduct\Entity\Product\Localized\Characteristic ;
use HcbStoreProduct\Entity\Product\Localized\CharacteristicBindInterface;

class CharacteristicBinderService
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
     * @param CharacteristicInterface $characteristicData
     * @param CharacteristicBindInterface $characteristicBinder
     */
    public function bind(CharacteristicInterface $characteristicData,
                         CharacteristicBindInterface $characteristicBinder)
    {
        $characteristicData = $characteristicData->getCharacteristic();
        $currentCharacteristics = $characteristicBinder->getCharacteristic();

        $currentCharacteristics->clear();
        if (empty($characteristicData)) {
            return;
        }
        foreach ($characteristicData as $characteristic) {
            list($name, $value) = array_map(function ($t){ return trim($t); },
                                            explode(':', $characteristic));

            $currentCharacteristics->filter(function ($characteristic) use ($name){
                return ($characteristic->getName() == $name);
            })->map(function ($characteristic) use ($characteristicBinder) {
                $characteristicBinder->removeCharacteristic($characteristic);
            });

            $characteristicEntity = $this->entityManager
                                ->getRepository
                                    ('HcbStoreProduct\Entity\Product\Localized\Characteristic')
                                ->findOneBy(array('name'=>$name,
                                                  'value'=>$value));

            if (is_null($characteristicEntity)) {
                $characteristicEntity = new Characteristic();
                $characteristicEntity->setName($name);
                $characteristicEntity->setValue($value);
                $this->entityManager->persist($characteristicEntity);
            }

            $this->entityManager->persist($characteristicBinder);
            $characteristicBinder->addCharacteristic($characteristicEntity);
        }
    }
}
