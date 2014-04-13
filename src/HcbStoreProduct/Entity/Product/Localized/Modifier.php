<?php
namespace HcbStoreProduct\Entity\Product\Localized;

use HcCore\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Modifier
 *
 * @ORM\Table(name="store_product_localized_modifier")
 * @ORM\Entity
 */
class Modifier implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="HcbStoreProduct\Entity\Product\Localized", cascade={"persist"})
     * @ORM\JoinTable(name="store_product_localized_has_modifier",
     *   joinColumns={
     *     @ORM\JoinColumn(name="store_product_localized_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="store_product_localized_modifier_id", referencedColumnName="id")
     *   }
     * )
     */
    private $localized;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->localized = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Modifier
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add localized
     *
     * @param \HcbStoreProduct\Entity\Product\Localized $localized
     * @return Modifier
     */
    public function addLocalized(\HcbStoreProduct\Entity\Product\Localized $localized)
    {
        $this->localized[] = $localized;

        return $this;
    }

    /**
     * Remove localized
     *
     * @param \HcbStoreProduct\Entity\Product\Localized $localized
     */
    public function removeLocalized(\HcbStoreProduct\Entity\Product\Localized $localized)
    {
        $this->localized->removeElement($localized);
    }

    /**
     * Get localized
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLocalized()
    {
        return $this->localized;
    }
}
