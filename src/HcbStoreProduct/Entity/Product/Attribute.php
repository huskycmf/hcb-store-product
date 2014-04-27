<?php
namespace HcbStoreProduct\Entity\Product;

use HcCore\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Attribute
 *
 * @ORM\Table(name="store_product_attribute")
 * @ORM\Entity
 */
class Attribute implements EntityInterface
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="HcbStoreProduct\Entity\Product", cascade={"persist"})
     * @ORM\JoinTable(name="store_product_has_attribute",
     *   joinColumns={
     *     @ORM\JoinColumn(name="store_product_attribute_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="store_product_id", referencedColumnName="id")
     *   }
     * )
     */
    private $product;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToOne(targetEntity="HcbStoreProduct\Entity\Product\Attribute\Type")
     * @ORM\JoinColumn(name="store_product_attribute_type_id", referencedColumnName="id")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200, nullable=false)
     */
    private $name;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->product = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Attribute
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
     * Add product
     *
     * @param \HcbStoreProduct\Entity\Product $product
     * @return Attribute
     */
    public function addProduct(\HcbStoreProduct\Entity\Product $product)
    {
        $this->product[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \HcbStoreProduct\Entity\Product $product
     */
    public function removeProduct(\HcbStoreProduct\Entity\Product $product)
    {
        $this->product->removeElement($product);
    }

    /**
     * Get product
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set type
     *
     * @param \HcbStoreProduct\Entity\Product\Attribute\Type $type
     * @return Attribute
     */
    public function setType(\HcbStoreProduct\Entity\Product\Attribute\Type $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \HcbStoreProduct\Entity\Product\Attribute\Type 
     */
    public function getType()
    {
        return $this->type;
    }
}
