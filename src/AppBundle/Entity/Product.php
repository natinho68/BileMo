<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 *
 *
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "app_product_show",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      )
 * )
 *
 * @Hateoas\Relation(
 *      "list_products",
 *      href = @Hateoas\Route(
 *          "app_product_list",
 *          absolute = true
 *      )
 * )
 *
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Serializer\Since("1.0")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     *
     * @Serializer\Since("1.0")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=5, scale=2)
     *
     * @Serializer\Since("1.0")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     *
     * @Serializer\Since("1.0")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity_available", type="integer")
     *
     * @Serializer\Since("1.0")
     */
    private $quantityAvailable;

    /**
     * @var string
     *
     * @ORM\Column(name="os", type="string", length=255)
     *
     * @Serializer\Since("1.0")
     */
    private $os;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255)
     *
     * @Serializer\Since("1.0")
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(name="technical_sheet", type="text")
     *
     * @Serializer\Since("1.0")
     */
    private $technicalSheet;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=255)
     *
     * @Serializer\Since("1.0")
     */
    private $brand;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
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
     * Set price
     *
     * @param string $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
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
     * Set quantityAvailable
     *
     * @param integer $quantityAvailable
     *
     * @return Product
     */
    public function setQuantityAvailable($quantityAvailable)
    {
        $this->quantityAvailable = $quantityAvailable;

        return $this;
    }

    /**
     * Get quantityAvailable
     *
     * @return int
     */
    public function getQuantityAvailable()
    {
        return $this->quantityAvailable;
    }

    /**
     * Set os
     *
     * @param string $os
     *
     * @return Product
     */
    public function setOs($os)
    {
        $this->os = $os;

        return $this;
    }

    /**
     * Get os
     *
     * @return string
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Product
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set technicalSheet
     *
     * @param string $technicalSheet
     *
     * @return Product
     */
    public function setTechnicalSheet($technicalSheet)
    {
        $this->technicalSheet = $technicalSheet;

        return $this;
    }

    /**
     * Get technicalSheet
     *
     * @return string
     */
    public function getTechnicalSheet()
    {
        return $this->technicalSheet;
    }

    /**
     * Set brand
     *
     * @param string $brand
     *
     * @return Product
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }
}
