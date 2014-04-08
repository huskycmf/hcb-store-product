<?php
namespace HcbStoreProduct\Entity\Product;

use HcBackend\Entity\PageBindInterface;
use HcBackend\Entity\PageInterface;
use HcbStoreProduct\Entity\Product;
use HcCore\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use HcCore\Entity\LocaleBindInterface;

/**
 * Localized
 *
 * @ORM\Table(name="store_product_localized")
 * @ORM\Entity
 */
class Localized implements EntityInterface, PageBindInterface, LocaleBindInterface
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
     * @ORM\Column(name="title", type="string", length=500, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", nullable=false)
     */
    private $description;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="HcbStoreProduct\Entity\Product", inversedBy="localized")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="store_product_id", referencedColumnName="id")
     * })
     */
    private $product;

    /**
     * @var Page
     *
     * @ORM\OneToOne(targetEntity="HcbStoreProduct\Entity\Product\Localized\Page", mappedBy="localized")
     */
    private $page;

    /**
     * @var Locale
     *
     * @ORM\OneToOne(targetEntity="HcCore\Entity\Locale")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="locale_id", referencedColumnName="id")
     * })
     */
    private $locale;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Localized
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set updatedTimestamp
     *
     * @param \DateTime $updatedTimestamp
     * @return Localized
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
     * Set createdTimestamp
     *
     * @param \DateTime $createdTimestamp
     * @return Localized
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
     * Set product
     *
     * @param \HcbStoreProduct\Entity\Product $product
     * @return Localized
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
     * Set page
     *
     * @param PageInterface $page
     * @return Localized
     */
    public function setPage(PageInterface $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \HcbStoreProduct\Entity\Product\Localized\Page 
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set locale
     *
     * @param \HcCore\Entity\Locale $locale
     * @return Localized
     */
    public function setLocale(\HcCore\Entity\Locale $locale = null)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return \HcCore\Entity\Locale 
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Localized
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
}
