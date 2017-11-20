<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use JMS\Serializer\SerializationContext;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Http\Client\Common\Exception\HttpClientNotFoundException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation as Doc;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\HttpFoundation\Response;
use FacebookTokenBundle\Entity\User;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use AppBundle\Exception\ResourceValidationException;

class UserController extends FOSRestController
{
    /**
     * @Rest\Get(
     *     path = "api/users/{id}",
     *     name = "app_user_show",
     *     requirements = {"id"="\d+"}
     * )
     * @View(serializerGroups={"list"})
     *
     * @Doc\ApiDoc(
     *     section="Users",
     *     resource=true,
     *     description="Get details of a particular user",
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
     *             "description"="The user unique identifier."
     *         }
     *     }
     * )
     *
     */
    public function showAction(User $user)
    {
        return $user;
    }

    /**
     * @Rest\Post(
     *     path = "/api/users",
     *     name = "app_user_create"
     * )
     *
     * @View(serializerGroups={"create"})
     *
     * @ParamConverter("user", converter="fos_rest.request_body")
     *
     *     @Doc\ApiDoc(
     *     section="Users",
     *     resource=true,
     *     description="Create an user",
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
     *         201="Returned when created",
     *         400="Returned when a violation is raised by validation"
     *     },
     *
     *      parameters={
     *          {"name"="username", "dataType"="string", "required"=true, "description"="the username"},
     *          {"name"="password", "dataType"="string", "required"=true, "description"="the user password"},
     *          {"name"="email", "dataType"="string", "required"=true, "description"="the user email"},
     *          {"name"="email", "dataType"="string", "required"=true, "description"="the user email"},
     *          {"name"="facebook_id", "dataType"="string", "required"=false, "description"="the user facebook id"},
     *          {"name"="first_name", "dataType"="string", "required"=false, "description"="the user firstname"},
     *          {"name"="last_name", "dataType"="string", "required"=false, "description"="the user lastname"},
     *          {"name"="picture", "dataType"="string", "required"=false, "description"="the user facebook profile picture"},
     *          {"name"="link", "dataType"="string", "required"=false, "description"="the user facebook profile link"}
     *
     *      }
     *
     *
     * )
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
        $password = $user->setPlainPassword($user->getPassword());
        $salty = $user->setSalt($password);
        $user->setPassword($salty);
        $user->addRole('ROLE_USER');
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
     *     path = "/api/users/",
     *     name = "app_user_list"
     * )
     *
     * @View(serializerGroups={"list"})
     *
     * @Doc\ApiDoc(
     *     section="Users",
     *     resource=true,
     *     description="Get the list of all users",
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
    public function listAction()
    {
        $users = $this->getDoctrine()->getRepository('FacebookTokenBundle\Entity\User')->findAll();
        return $users;
    }

}
