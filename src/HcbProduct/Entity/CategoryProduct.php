<?php
namespace HcbProduct\Entity;

use HcBackend\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * CategoryProduct
 *
 * @ORM\Table(name="category_product")
 * @ORM\Entity
 */
class CategoryProduct implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
}
