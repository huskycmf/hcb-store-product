<?php
namespace HcbStoreProduct\Entity\Product\Localized;

use Doctrine\ORM\Mapping as ORM;
use HcBackend\Entity\MappedPage;
use HcbStoreProduct\Entity\Product\Localized;
use HcCore\Entity\EntityInterface;

/**
 * Page
 *
 * @ORM\Table(name="store_product_locale_page")
 * @ORM\Entity
 */
class Page extends MappedPage implements EntityInterface
{
    /**
     * @var Localized
     *
     * @ORM\OneToOne(targetEntity="HcbStoreProduct\Entity\Product\Localized", inversedBy="page")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="store_product_localized_id", referencedColumnName="id")
     * })
     */
    private $localized;

    /**
     * Set localized
     *
     * @param \HcbStoreProduct\Entity\Product\Localized $localized
     * @return Page
     */
    public function setLocalized(\HcbStoreProduct\Entity\Product\Localized $localized = null)
    {
        $this->localized = $localized;

        return $this;
    }

    /**
     * Get localized
     *
     * @return \HcbStoreProduct\Entity\Product\Localized 
     */
    public function getLocalized()
    {
        return $this->localized;
    }
}
