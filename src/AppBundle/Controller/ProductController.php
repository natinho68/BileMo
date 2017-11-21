<?php
namespace AppBundle\Controller;
use AppBundle\Exception\ResourceValidationException404;
use AppBundle\Representation\Products;
use Http\Client\Common\Exception\HttpClientNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Nelmio\ApiDocBundle\Annotation as Doc;
use AppBundle\Exception\ResourceValidationException;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use Symfony\Component\Debug\ErrorHandler;
class ProductController extends Controller
{
    /**
     * @Get(
     *     path = "/api/products/{id}",
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
     *     },
     *
     *     statusCodes={
     *         200="Returned when request was accepted successfully",
     *         400="Returned when a violation is raised by validation"
     *     },
     *
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
     *     path = "/api/products/",
     *     name = "app_product_list"
     * )
     *
     * @Rest\QueryParam(
     *     name="keyword",
     *     requirements="[a-zA-Z0-9]+",
     *     nullable=true,
     *     description="The keyword to search for."
     * )
     * @Rest\QueryParam(
     *     name="order",
     *     requirements="asc|desc",
     *     default="asc",
     *     description="Sort order (asc or desc)."
     * )
     * @Rest\QueryParam(
     *     name="limit",
     *     requirements="\d+",
     *     default="7",
     *     description="Max number of categories per page."
     * )
     * @Rest\QueryParam(
     *     name="offset",
     *     requirements="\d+",
     *     default="0",
     * description="The pagination offset."
     * )
     *
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
     *     },
     *
     *     statusCodes={
     *         200="Returned when request was accepted successfully",
     *         400="Returned when a violation is raised by validation"
     *     }
     *
     * )
     */

    public function listAction(ParamFetcherInterface $paramFetcher)
    {
        $pager = $this->getDoctrine()->getRepository('AppBundle:Product')->search(
            $paramFetcher->get('keyword'),
            $paramFetcher->get('order'),
            $paramFetcher->get('limit'),
            $paramFetcher->get('offset')
        );

        return new Products($pager);
    }
}
