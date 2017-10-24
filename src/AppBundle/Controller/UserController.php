<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class UserController extends Controller
{

    /**
     * @Get(
     *     path = "/users/{id}",
     *     name = "app_user_show",
     *     requirements = {"id"="\d+"}
     * )
     * @View
     */
    public function showAction(User $user)
    {
        return $user;
    }

    /**
     * @Post(
     *     path = "/users/",
     *     name = "app_user_create"
     * )
     * @View
     */
    public function createAction(User $user)
    {
        return $user;
    }

    /**
     * @Get(
     *     path = "/users/",
     *     name = "app_user_list"
     * )
     * @View
     */
    public function listAction()
    {
        $users = $this->getDoctrine()->getRepository('AppBundle\Entity\User')->findAll();
        return $users;
    }
}