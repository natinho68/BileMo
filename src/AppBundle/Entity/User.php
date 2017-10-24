<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\Length(min=4)
     * @Assert\NotNull()
     */
    protected $username;

    /**
    * @Assert\Length(
    *     min=8,
    *     max=15,
    * )
    * @Assert\NotNull()
    */
    protected $plainPassword;

    /**
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     * @Assert\NotNull()
     */
    protected $email;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}
