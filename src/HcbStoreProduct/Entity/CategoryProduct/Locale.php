<?php
namespace HcbStoreProduct\CategoryProduct;

use HcbStoreProduct\Entity\CategoryProduct;
use HcCore\Entity\EntityInterface;
use HcBackend\Entity\PageBindInterface;
use Doctrine\ORM\Mapping as ORM;
use HcBackend\Entity\ImageBindInterface;
use Zf2FileUploader\Entity\ImageInterface;

/**
 * Locale
 *
 * @ORM\Table(name="category_product_locale")
 * @ORM\Entity
 */
class Locale implements EntityInterface, ImageBindInterface, PageBindInterface
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
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content = '';

    /**
     * @var CategoryProduct
     *
     * @ORM\ManyToOne(targetEntity="HcbStoreProduct\Entity\CategoryProduct")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_product_id", referencedColumnName="id")
     * })
     */
    private $categoryProduct = null;

    /**
     * @var CategoryProduct\Page
     *
     * @ORM\OneToOne(targetEntity="HcBackend\Entity\CategoryProduct\Page")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="page_id", referencedColumnName="id")
     * })
     */
    private $page = null;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="HcBackend\Entity\Image", cascade={"persist"})
     * @ORM\JoinTable(name="category_product_locale_image",
     *   joinColumns={
     *     @ORM\JoinColumn(name="category_product_locale_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     *   }
     * )
     */
    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_timestamp", type="datetime", nullable=false)
     */
    private $updatedTimestamp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_timestamp", type="datetime", nullable=false)
     */
    private $createdTimestamp;

    /**
     * Add image
     *
     * @param ImageInterface $image
     * @return Locale
     */
    public function addImage(ImageInterface $image)
    {
        $this->image[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param ImageInterface $image
     */
    public function removeImage(ImageInterface $image)
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
}
