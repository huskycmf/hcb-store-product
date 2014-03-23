<?php
namespace HcbStoreProduct\Entity;

use HcCore\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="store_product")
 * @ORM\Entity
 */
class Product implements EntityInterface
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
     * @var integer
     *
     * @ORM\Column(name="enabled", type="integer", nullable=false)
     */
    private $enabled = 0;

    /**
     * @var Product\Localized
     *
     * @ORM\OneToMany(targetEntity="HcbStoreProduct\Entity\Product\Localized", mappedBy="product")
     * @ORM\OrderBy({"updatedTimestamp" = "DESC"})
     */
    private $localized = null;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_timestamp", type="datetime", nullable=false)
     */
    private $createdTimestamp;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->localized = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set createdTimestamp
     *
     * @param \DateTime $createdTimestamp
     * @return Product
     */
    public function setCreatedTimestamp($createdTimestamp)
    {
        $this->createdTimestamp = $createdTimestamp;

        return $this;
    }

    /**
     * Get createdTimestamp
     *
     * @return \DateTime
     */
    public function getCreatedTimestamp()
    {
        return $this->createdTimestamp;
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
     * Set enabled
     *
     * @param int $enabled
     * @return Product
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return int
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Add localized
     *
     * @param \HcbStoreProduct\Entity\Product\Localized $localized
     * @return Product
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
