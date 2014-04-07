<?php
namespace HcbStoreProduct\Entity;

use HcCore\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Zf2FileUploader\Entity\Image;

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
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    private $enabled = false;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", nullable=false)
     */
    private $price;

    /**
     * @var float
     *
     * @ORM\Column(name="price_deal", type="float", nullable=false)
     */
    private $priceDeal;

    /**
     * @var Image
     *
     * @ORM\OneToOne(targetEntity="Zf2FileUploader\Entity\Image")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="image_3d_id", referencedColumnName="id")
     * })
     */
    private $image3d;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_timestamp", type="datetime", nullable=false)
     */
    private $createdTimestamp;

    /**
     * @var \HcbStoreProduct\Entity\Product\Image
     *
     * @ORM\OneToMany(targetEntity="HcbStoreProduct\Entity\Product\Image", mappedBy="product")
     * @ORM\OrderBy({"priority" = "ASC"})
     */
    private $image = null;

    /**
     * @var Product\Localized
     *
     * @ORM\OneToMany(targetEntity="HcbStoreProduct\Entity\Product\Localized", mappedBy="product")
     * @ORM\OrderBy({"updatedTimestamp" = "DESC"})
     */
    private $localized = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->image = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set enabled
     *
     * @param boolean $enabled
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
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set priceDeal
     *
     * @param float $priceDeal
     * @return Product
     */
    public function setPriceDeal($priceDeal)
    {
        $this->priceDeal = $priceDeal;

        return $this;
    }

    /**
     * Get priceDeal
     *
     * @return float 
     */
    public function getPriceDeal()
    {
        return $this->priceDeal;
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
     * Set image3d
     *
     * @param \Zf2FileUploader\Entity\Image $image3d
     * @return Product
     */
    public function setImage3d(\Zf2FileUploader\Entity\Image $image3d = null)
    {
        $this->image3d = $image3d;

        return $this;
    }

    /**
     * Get image3d
     *
     * @return \Zf2FileUploader\Entity\Image 
     */
    public function getImage3d()
    {
        return $this->image3d;
    }

    /**
     * Add image
     *
     * @param \HcbStoreProduct\Entity\Product\Image $image
     * @return Product
     */
    public function addImage(\HcbStoreProduct\Entity\Product\Image $image)
    {
        $this->image[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \HcbStoreProduct\Entity\Product\Image $image
     */
    public function removeImage(\HcbStoreProduct\Entity\Product\Image $image)
    {
        $this->image->removeElement($image);
    }

    /**
     * Get image
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImage()
    {
        return $this->image;
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
