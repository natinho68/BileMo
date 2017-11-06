<?php

namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Hateoas\Configuration\Annotation as Hateoas;

/**
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "app_user_show",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      )
 * )
 *
 * @Hateoas\Relation(
 *      "list_user",
 *      href = @Hateoas\Route(
 *          "app_product_list",
 *          absolute = true
 *      )
 * )
 *
 * @Hateoas\Relation(
 *      "create_user",
 *      href = @Hateoas\Route(
 *          "app_user_create",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      )
 * )
 *
 */


class User implements UserInterface
{

    private $name;
    private $id;

    public function __construct($name, $id)
    {
        $this->name = $name;
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUsername()
    {
        return $this->name;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getPassword()
    {
    }

    public function getSalt()
    {
    }

    public function eraseCredentials()
    {
    }
}