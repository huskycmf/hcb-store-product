<?php
namespace HcbStoreProduct\Entity;

use HcBackend\Entity\AliasWiredAwareInterface;
use HcBackend\Entity\LocalizedInterface;
use HcCore\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use HcBackend\Entity\Image;

/**
 * Product
 *
 * @ORM\Table(name="store_product")
 * @ORM\Entity
 */
class Product implements EntityInterface, LocalizedInterface, AliasWiredAwareInterface
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
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;

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
     * @ORM\OneToOne(targetEntity="HcBackend\Entity\Image")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="image_3d_id", referencedColumnName="id")
     * })
     */
    private $image3d;

    /**
     * @var Product
     *
     * @ORM\OneToOne(targetEntity="HcbStoreProduct\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="store_product_id", referencedColumnName="id")
     * })
     */
    private $product;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_timestamp", type="datetime", nullable=false)
     */
    private $createdTimestamp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_timestamp", type="datetime", nullable=false)
     */
    private $updatedTimestamp;

    /**
     * @var \HcbStoreProduct\Entity\Product\Image
     *
     * @ORM\OneToMany(targetEntity="HcbStoreProduct\Entity\Product\Image", mappedBy="product")
     * @ORM\OrderBy({"priority" = "ASC"})
     */
    private $image;

    /**
     * @var \HcbStoreProduct\Entity\Product\Alias
     *
     * @ORM\OneToMany(targetEntity="HcbStoreProduct\Entity\Product\Alias", mappedBy="product")
     */
    private $alias;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="HcbStoreProduct\Entity\Product\Attribute", cascade={"persist"})
     * @ORM\JoinTable(name="store_product_has_attribute",
     *   joinColumns={
     *     @ORM\JoinColumn(name="store_product_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="store_product_attribute_id", referencedColumnName="id")
     *   }
     * )
     */
    private $attribute;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="HcbStoreProduct\Entity\Product\Label", cascade={"persist"})
     * @ORM\JoinTable(name="store_product_has_label",
     *   joinColumns={
     *     @ORM\JoinColumn(name="store_product_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="store_product_label_id", referencedColumnName="id")
     *   }
     * )
     * @ORM\OrderBy({"priority" = "ASC"})
     */
    private $label;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="HcbStoreProduct\Entity\Product\Kit", cascade={"persist"})
     * @ORM\JoinTable(name="store_product_kit_has_product",
     *   joinColumns={
     *     @ORM\JoinColumn(name="store_product_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="store_product_kit_id", referencedColumnName="id")
     *   }
     * )
     */
    private $kit;

    /**
     * @var Product\Localized
     *
     * @ORM\OneToMany(targetEntity="HcbStoreProduct\Entity\Product\Localized", mappedBy="product")
     */
    private $localized;

    /**
     * @var string
     *
     * @ORM\Column(name="file_instruction", type="string", nullable=false)
     */
    private $fileInstruction;

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
     * Set status
     *
     * @param integer $status
     * @return Product
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
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
     * @param \HcBackend\Entity\Image $image3d
     * @return Product
     */
    public function setImage3d(\HcBackend\Entity\Image $image3d = null)
    {
        $this->image3d = $image3d;

        return $this;
    }

    /**
     * Get image3d
     *
     * @return \HcBackend\Entity\Image
     */
    public function getImage3d()
    {
        return $this->image3d;
    }

    /**
     * Set product
     *
     * @param \HcbStoreProduct\Entity\Product $product
     * @return Product
     */
    public function setProduct(\HcbStoreProduct\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \HcbStoreProduct\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
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
     * Add attribute
     *
     * @param \HcbStoreProduct\Entity\Product\Attribute $attribute
     * @return Product
     */
    public function addAttribute(\HcbStoreProduct\Entity\Product\Attribute $attribute)
    {
        $this->attribute[] = $attribute;

        return $this;
    }

    /**
     * Remove attribute
     *
     * @param \HcbStoreProduct\Entity\Product\Attribute $attribute
     */
    public function removeAttribute(\HcbStoreProduct\Entity\Product\Attribute $attribute)
    {
        $this->attribute->removeElement($attribute);
    }

    /**
     * Get attribute
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * Add label
     *
     * @param \HcbStoreProduct\Entity\Product\Label $label
     * @return Product
     */
    public function addLabel(\HcbStoreProduct\Entity\Product\Label $label)
    {
        $this->label[] = $label;

        return $this;
    }

    /**
     * Remove label
     *
     * @param \HcbStoreProduct\Entity\Product\Label $label
     */
    public function removeLabel(\HcbStoreProduct\Entity\Product\Label $label)
    {
        $this->label->removeElement($label);
    }

    /**
     * Get label
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLabel()
    {
        return $this->label;
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

    /**
     * Set updatedTimestamp
     *
     * @param \DateTime $updatedTimestamp
     * @return Product
     */
    public function setUpdatedTimestamp($updatedTimestamp)
    {
        $this->updatedTimestamp = $updatedTimestamp;

        return $this;
    }

    /**
     * Get updatedTimestamp
     *
     * @return \DateTime
     */
    public function getUpdatedTimestamp()
    {
        return $this->updatedTimestamp;
    }

    /**
     * Add alias
     *
     * @param \HcbStoreProduct\Entity\Product\Alias $alias
     * @return Product
     */
    public function addAlias(\HcbStoreProduct\Entity\Product\Alias $alias)
    {
        $this->alias[] = $alias;

        return $this;
    }

    /**
     * Remove alias
     *
     * @param \HcbStoreProduct\Entity\Product\Alias $alias
     */
    public function removeAlias(\HcbStoreProduct\Entity\Product\Alias $alias)
    {
        $this->alias->removeElement($alias);
    }

    /**
     * Get alias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set fileInstruction
     *
     * @param string $fileInstruction
     * @return Product
     */
    public function setFileInstruction($fileInstruction)
    {
        $this->fileInstruction = $fileInstruction;

        return $this;
    }

    /**
     * Get fileInstruction
     *
     * @return string
     */
    public function getFileInstruction()
    {
        return $this->fileInstruction;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->image = new \Doctrine\Common\Collections\ArrayCollection();
        $this->alias = new \Doctrine\Common\Collections\ArrayCollection();
        $this->attribute = new \Doctrine\Common\Collections\ArrayCollection();
        $this->label = new \Doctrine\Common\Collections\ArrayCollection();
        $this->kit = new \Doctrine\Common\Collections\ArrayCollection();
        $this->localized = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add kit
     *
     * @param \HcbStoreProduct\Entity\Product\Kit $kit
     * @return Product
     */
    public function addKit(\HcbStoreProduct\Entity\Product\Kit $kit)
    {
        $this->kit[] = $kit;

        return $this;
    }

    /**
     * Remove kit
     *
     * @param \HcbStoreProduct\Entity\Product\Kit $kit
     */
    public function removeKit(\HcbStoreProduct\Entity\Product\Kit $kit)
    {
        $this->kit->removeElement($kit);
    }

    /**
     * Get kit
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getKit()
    {
        return $this->kit;
    }
}
