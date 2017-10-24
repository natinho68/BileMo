<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;

class ProductController extends Controller
{
    /**
     * @Get(
     *     path = "/products/{id}",
     *     name = "app_product_show",
     *     requirements = {"id"="\d+"}
     * )
     * @View
     */
    public function showAction(Product $product)
    {
        return $product;
    }

    /**
     * @Get(
     *     path = "/products/",
     *     name = "app_product_list"
     * )
     * @View
     */
    public function listAction()
    {
        $products = $this->getDoctrine()->getRepository('AppBundle\Entity\Product')->findAll();
        return $products;
    }
}