<?php

namespace AppBundle\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class FacebookAuthenticator extends AbstractGuardAuthenticator
{
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Called when authentication is needed, but it's not sent
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = array(
            // you might translate this message
            'message' => 'Authentication Required. If you sent an authorization header with your access token, please recheck it.'
        );

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }
    /**
     * Called on every request. Return whatever credentials you want to
     * be passed to getUser(). Returning null will cause this authenticator
     * to be skipped.
     */
    public function getCredentials(Request $request)
    {
        if (!$request->headers->has('Authorization')) {
            throw new AuthenticationException();
        }

        if (!$token = $request->headers->get('Authorization')) {
            // No token?
            $token = null;
        }

        // What you return here will be passed to getUser() as $credentials
        return array(
            'token' => $token,
        );
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $user = $this->em->getRepository('FacebookTokenBundle:User')
            ->findOneBy(array('facebookAccessToken' => $credentials));
        return $user;

    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        if ($user->getFacebookAccessToken() === $credentials['token']) {
            return true;
        }
        return new JsonResponse(array('message' => 'The facebook access token is wrong!', Response::HTTP_FORBIDDEN));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // on success, let the request continue
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {

    }

    public function supportsRememberMe()
    {
        return false;
    }
}