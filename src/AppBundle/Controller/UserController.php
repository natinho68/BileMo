<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class UserController extends FOSRestController
{

    /**
     * @Rest\Get(
     *     path = "/users/{id}",
     *     name = "app_user_show",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View
     */
    public function showAction(User $user)
    {
        return $user;
    }

    /**
     * @Rest\Post(
     *     path = "/users",
     *     name = "app_user_create"
     * )
     * @Rest\View(StatusCode=201)
     * @ParamConverter("user", converter="fos_rest.request_body")
     */
    public function createAction(User $user, ConstraintViolationList $violations)
    {
        if (count($violations)) {
            return $this->view($violations, Response::HTTP_BAD_REQUEST);
        }

        $em = $this->getDoctrine()->getManager();
        $user->setEnabled(true);
        $em->persist($user);
        $em->flush();

        return $this->view(
            $user,
            Response::HTTP_CREATED,
            [
                'Location' => $this->generateUrl('app_user_show', ['id' => $user->getId(), UrlGeneratorInterface::ABSOLUTE_URL])
            ]
        );
    }

    /**
     * @Rest\Get(
     *     path = "/users/",
     *     name = "app_user_list"
     * )
     * @Rest\View
     */
    public function listAction()
    {
        $users = $this->getDoctrine()->getRepository('AppBundle\Entity\User')->findAll();
        return $users;
    }

}