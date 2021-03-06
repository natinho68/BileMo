<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

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
 *
 * @Hateoas\Relation(
 *     "authenticated_user",
 *     embedded = @Hateoas\Embedded("expr(service('security.token_storage').getToken().getUser())")
 * )
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
     * @ORM\Column(name="price", type="decimal", precision=6, scale=2)
     *
     * @Serializer\Since("1.0")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="capacity", type="string", length=255,)
     *
     * @Serializer\Since("1.0")
     */
    private $capacity;


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
     * @ORM\Column(name="technical_spec", type="text")
     *
     * @Serializer\Since("1.0")
     */
    private $technicalSpec;

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

    /**
     * Set capacity
     *
     * @param string $capacity
     *
     * @return Product
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return string
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set technicalSpec
     *
     * @param string $technicalSpec
     *
     * @return Product
     */
    public function setTechnicalSpec($technicalSpec)
    {
        $this->technicalSpec = $technicalSpec;

        return $this;
    }

    /**
     * Get technicalSpec
     *
     * @return string
     */
    public function getTechnicalSpec()
    {
        return $this->technicalSpec;
    }
}
