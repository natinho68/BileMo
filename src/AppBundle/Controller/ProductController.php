<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Nelmio\ApiDocBundle\Annotation as Doc;
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
     *
     * @Doc\ApiDoc(
     *     section="Products",
     *     resource=true,
     *     description="Get details of a particular product",
     *     headers={
     *         {
     *             "name"="Authorization",
     *             "description"="Facebook Token Access",
     *             "required"="true"
     *
     *         }
     *     }
     *     )
     *     statusCodes={
     *         200="Returned when request was accepted successfully",
     *         400="Returned when a violation is raised by validation"
     *     }
     * )
     *     requirements={
     *         {
     *             "name"="id",
     *             "dataType"="integer",
     *             "requirements"="\d+",
     *             "description"="The product unique identifier."
     *         }
     *     }
     * )
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
     *
     * @Doc\ApiDoc(
     *     section="Products",
     *     resource=true,
     *     description="Get the list of all products",
     *     headers={
     *         {
     *             "name"="Authorization",
     *             "description"="Facebook Token Access",
     *             "required"="true"
     *
     *         }
     *     }
     *     )
     *     statusCodes={
     *         200="Returned when request was accepted successfully",
     *         400="Returned when a violation is raised by validation"
     *     }
     * )
     * )
     */
    public function listAction()
    {
        $products = $this->getDoctrine()->getRepository('AppBundle\Entity\Product')->findAll();
        return $products;
    }
}