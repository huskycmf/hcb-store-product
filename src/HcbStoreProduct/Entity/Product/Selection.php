<?php
namespace HcbStoreProduct\Entity\Product;

use HcCore\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Selection
 *
 * @ORM\Table(name="store_product_selection")
 * @ORM\Entity
 */
class Selection implements EntityInterface
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
     * @ORM\JoinTable(name="store_product_selection_has_product",
     *   joinColumns={
     *     @ORM\JoinColumn(name="store_product_selection_id", referencedColumnName="id")
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
     * @ORM\OneToOne(targetEntity="HcBackend\Entity\Image")
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="float", nullable=false)
     */
    private $price;

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
     * Set price
     *
     * @param float $price
     * @return Selection
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
     * Add product
     *
     * @param \HcbStoreProduct\Entity\Product $product
     * @return Selection
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
     * Set image
     *
     * @param \HcBackend\Entity\Image $image
     * @return Selection
     */
    public function setImage(\HcBackend\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \HcBackend\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }
}
