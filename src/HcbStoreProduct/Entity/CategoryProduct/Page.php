<?php
namespace HcbStoreProduct\Entity\CategoryProduct;

use Doctrine\ORM\Mapping as ORM;
use HcBackend\Entity\MappedPage;
use HcCore\Entity\EntityInterface;

/**
 * Page
 *
 * @ORM\Table(name="category_product_page")
 * @ORM\Entity
 */
class Page extends MappedPage implements EntityInterface {}
