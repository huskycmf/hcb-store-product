<?php
namespace HcbStoreProduct\Entity\Product;

use HcCore\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="store_product_image")
 * @ORM\Entity
 */
class Image implements EntityInterface
{
    /**
     * @var \Zf2FileUploader\Entity\Image
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="\Zf2FileUploader\Entity\Image")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     * })
     */
    private $image;

    /**
     * @var \HcbStoreProduct\Entity\Product
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="\HcbStoreProduct\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="store_product_id", referencedColumnName="id")
     * })
     */
    private $product;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=false)
     */
    private $priority;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_preview", type="boolean", nullable=false)
     */
    private $isPreview = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_timestamp", type="datetime", nullable=false)
     */
    private $createdTimestamp;

    /**
     * Set priority
     *
     * @param integer $priority
     * @return Image
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set isPreview
     *
     * @param boolean $isPreview
     * @return Image
     */
    public function setIsPreview($isPreview)
    {
        $this->isPreview = $isPreview;

        return $this;
    }

    /**
     * Get isPreview
     *
     * @return boolean 
     */
    public function getIsPreview()
    {
        return $this->isPreview;
    }

    /**
     * Set createdTimestamp
     *
     * @param \DateTime $createdTimestamp
     * @return Image
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
     * Set image
     *
     * @param \Zf2FileUploader\Entity\Image $image
     * @return Image
     */
    public function setImage(\Zf2FileUploader\Entity\Image $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Zf2FileUploader\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set product
     *
     * @param \HcbStoreProduct\Entity\Product $product
     * @return Image
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
