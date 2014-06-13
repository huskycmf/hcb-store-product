<?php
namespace HcbStoreProduct\Entity\Product;

use HcBackend\Entity\AliasWiredInterface;
use HcCore\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Alias
 *
 * @ORM\Table(name="store_product_has_alias")
 * @ORM\Entity
 */
class Alias implements EntityInterface, AliasWiredInterface
{
    /**
     * @var \HcbStoreProduct\Entity\Product\Alias
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="\HcBackend\Entity\Alias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="alias_id", referencedColumnName="id")
     * })
     */
    private $alias;

    /**
     * @var \HcbStoreProduct\Entity\Product
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="\HcbStoreProduct\Entity\Product", inversedBy="alias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="store_product_id", referencedColumnName="id")
     * })
     */
    private $product;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_primary", type="boolean", nullable=true)
     */
    private $isPrimary;

    /**
     * Set isPrimary
     *
     * @param boolean $isPrimary
     * @return Alias
     */
    public function setIsPrimary($isPrimary)
    {
        $this->isPrimary = $isPrimary;

        return $this;
    }

    /**
     * Get isPrimary
     *
     * @return boolean 
     */
    public function getIsPrimary()
    {
        return $this->isPrimary;
    }

    /**
     * Set alias
     *
     * @param \HcBackend\Entity\Alias $alias
     * @return Alias
     */
    public function setAlias(\HcBackend\Entity\Alias $alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return \HcBackend\Entity\Alias 
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set product
     *
     * @param \HcbStoreProduct\Entity\Product $product
     * @return Alias
     */
    public function setProduct(\HcbStoreProduct\Entity\Product $product)
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
}
