<?php

namespace FacebookTokenBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation\Expose;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\ExclusionPolicy;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ExclusionPolicy("all")
 *
 *
 * @ORM\Entity
 * @ORM\Table(name="user")
 *
 */
class User extends BaseUser implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Expose
     * @ORM\Column(name="facebook_id",type="text",  nullable=true)
     */
    protected $facebookID;

    /** @ORM\Column(name="facebook_access_token", type="text", nullable=true) */
    protected $facebook_access_token;

    /**
     * @Expose
     * @ORM\Column(name="first_name", type="string", length=255, nullable=true)
     *
     */
    protected $firstName;

    /**
     * @Expose
     * @ORM\Column(name="last_name", type="string", length=255, nullable=true) */
    protected $lastName;

    /**
     * @Expose
     * @ORM\Column(name="picture", type="string", length=255, nullable=true) */
    protected $picture;

    /**
     * @Expose
     * @ORM\Column(name="link", type="string", length=255, nullable=true) */
    protected $link;

    /**
     * @Assert\Email()
     * @Assert\NotNull()
     * @Assert\NotBlank()*/
    protected $email;

    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    protected $password;

    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    protected $username;

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

    /**
     * Set facebookAccessToken
     *
     * @param string $facebookAccessToken
     *
     * @return User
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebook_access_token = $facebookAccessToken;

        return $this;
    }

    /**
     * Get facebookAccessToken
     *
     * @return string
     */
    public function getFacebookAccessToken()
    {
        return $this->facebook_access_token;
    }


    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return User
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return User
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }
}
