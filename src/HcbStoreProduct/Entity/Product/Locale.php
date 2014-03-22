<?php
namespace HcbStoreProduct\Entity\Product;

//use HcBackend\Entity\PageInterface;
use HcbStoreProduct\Entity\Product;
use HcCore\Entity\EntityInterface;
//use HcBackend\Entity\PageBindInterface;
//use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use HcbStaticPage\Entity\StaticPage;
//use HcBackend\Entity\ImageBindInterface;
//use Zf2FileUploader\Entity\ImageInterface;

/**
 * Locale
 *
 * @ORM\Table(name="store_product_locale")
 * @ORM\Entity
 */
class Locale implements EntityInterface/*, ImageBindInterface, PageBindInterface*/
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
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="HcbStoreProduct\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="store_product_id", referencedColumnName="id")
     * })
     */
    private $product;

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
}
