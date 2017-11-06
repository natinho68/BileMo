<?php

namespace AppBundle\Security;

use AppBundle\Entity\User;
use GuzzleHttp\Client;
use JMS\Serializer\Serializer;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class FacebookUserProvider implements UserProviderInterface
{
    private $client;

    public function __construct(Client $client, Serializer $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;
    }

    public function loadUserByUsername($accessToken)
    {
        $response = $this->client->request('GET', 'https://graph.facebook.com/me?fields=id,name,gender,link,picture,email', [
            'headers' => [
                'Authorization' => $accessToken
            ]
        ]);

        $res = $response->getBody()->getContents();
        $userData = $this->serializer->deserialize($res, 'array', 'json');

        if (!$userData) {
            throw new \LogicException('Did not managed to get your user info from Facebook.');
        }

        return new User($userData['name'], $userData['id']);
    }

    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException();
        }

        return $user;
    }

    public function supportsClass($class)
    {
        return 'AppBundle\Entity\User' === $class;
    }
}