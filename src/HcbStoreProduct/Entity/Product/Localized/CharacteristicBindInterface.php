<?php
namespace HcbStoreProduct\Entity\Product\Localized;

use HcbStoreProduct\Entity\Product\Localized;
use Doctrine\ORM\Mapping as ORM;

/**
 * Characteristic
 *
 * @ORM\Table(name="store_product_localized_characteristic")
 * @ORM\Entity
 */
interface CharacteristicBindInterface
{
    /**
     * Add characteristic
     *
     * @param \HcbStoreProduct\Entity\Product\Localized\Characteristic $characteristic
     * @return Localized
     */
    public function addCharacteristic(\HcbStoreProduct\Entity\Product\Localized\Characteristic $characteristic);

    /**
     * Remove characteristic
     *
     * @param \HcbStoreProduct\Entity\Product\Localized\Characteristic $characteristic
     */
    public function removeCharacteristic(\HcbStoreProduct\Entity\Product\Localized\Characteristic $characteristic);

    /**
     * Get characteristic
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCharacteristic();
}
