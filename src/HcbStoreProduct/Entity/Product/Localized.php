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
     * @ORM\Column(name="short_description", type="string", nullable=false)
     */
    private $shortDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="extra_description", type="string", nullable=false)
     */
    private $extraDescription;

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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="HcbStoreProduct\Entity\Product\Localized\Characteristic", cascade={"persist"})
     * @ORM\OrderBy({"priority" = "ASC"})
     * @ORM\JoinTable(name="store_product_localized_has_characteristic",
     *   joinColumns={
     *     @ORM\JoinColumn(name="store_product_localized_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="store_product_localized_characteristic_id", referencedColumnName="id")
     *   }
     * )
     */
    private $characteristic;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->characteristic = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set shortDescription
     *
     * @param string $shortDescription
     * @return Localized
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string 
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
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
     * @return PageInterface
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
     * Add characteristic
     *
     * @param \HcbStoreProduct\Entity\Product\Localized\Characteristic $characteristic
     * @return Localized
     */
    public function addCharacteristic(\HcbStoreProduct\Entity\Product\Localized\Characteristic $characteristic)
    {
        $this->characteristic[] = $characteristic;

        return $this;
    }

    /**
     * Remove characteristic
     *
     * @param \HcbStoreProduct\Entity\Product\Localized\Characteristic $characteristic
     */
    public function removeCharacteristic(\HcbStoreProduct\Entity\Product\Localized\Characteristic $characteristic)
    {
        $this->characteristic->removeElement($characteristic);
    }

    /**
     * Get characteristic
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCharacteristic()
    {
        return $this->characteristic;
    }

    /**
     * Set extraDescription
     *
     * @param string $extraDescription
     * @return Localized
     */
    public function setExtraDescription($extraDescription)
    {
        $this->extraDescription = $extraDescription;

        return $this;
    }

    /**
     * Get extraDescription
     *
     * @return string 
     */
    public function getExtraDescription()
    {
        return $this->extraDescription;
    }
}
