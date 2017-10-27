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
use AppBundle\Exception\ResourceValidationException;

class UserController extends FOSRestController
{


    public function authentification()
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://graph.facebook.com/me?fields=id,name', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization'     => 'Bearer EAAB58F0ToY8BAG3kHzNJz0VA6poquLKkYIXZAXRIqxy3bZAZAZCLa3AUrk0oEjFZAcxuXLfc2eGsyHZAq55SolkhiRYZC6OPNWo3TZBmFjEI4XRV9FbxnKSoXceddQDoesCbvq6pxnbVqlSznmdZBscQoP5B63vjv7Phbq8dy2nyHSwZDZD'
            ]
        ]);
        $ok = $res->getStatusCode();
        if($ok != 200){
            echo $res->getReasonPhrase();
        } else {
            return true;
        }

// 200
// 'application/json; charset=utf8'
// '{"id": 1420053, "name": "guzzle", ...}'
    }

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
            $message = 'The JSON sent contains invalid data. Here are the errors you need to correct: ';
            foreach ($violations as $violation) {
                $message .= sprintf("Field %s: %s ", $violation->getPropertyPath(), $violation->getMessage());
            }

            throw new ResourceValidationException($message);
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
        $this->authentification();
        $users = $this->getDoctrine()->getRepository('AppBundle\Entity\User')->findAll();
        return $users;
    }

}