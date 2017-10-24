<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use JMS\Serializer\Annotation as Serializer;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @Serializer\ExclusionPolicy("ALL")
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
     * @Serializer\Expose
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
     * @Serializer\Expose
     */
    protected $email;

    /**
     * @ORM\Column(type="string")
     */
    protected $facebookID;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set facebookID
     *
     * @param string $facebookID
     *
     * @return User
     */
    public function setFacebookID($facebookID)
    {
        $this->facebookID = $facebookID;

        return $this;
    }

    /**
     * Get facebookID
     *
     * @return string
     */
    public function getFacebookID()
    {
        return $this->facebookID;
    }
}
