<?php

namespace App\Security;

use App\Utils\Util;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Security\Authenticator\OAuth2Authenticator;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\FacebookUser;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\File;
use Psr\Container\ContainerInterface;

class FacebookAuthenticator extends OAuth2Authenticator
{
    /**
     * @var ClientRegistry
     */
    private $clientRegistry;

    /**
     * @var EntityManagerInterface
     */
    private $em;

	/**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;
	
	/**
     * @var RouterInterface
     */
	private $router;
	
	/**
     * @var SluggerInterface
     */
	private $slugger;
	
	/**
     * @var ContainerInterface
     */
	private $container;

    /**
     * FacebookAuthenticator constructor.
     * @param ClientRegistry $clientRegistry
     * @param EntityManagerInterface $em
	 * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(ClientRegistry $clientRegistry, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder, RouterInterface $router, SluggerInterface $slugger,ContainerInterface $container)
    {
        $this->clientRegistry = $clientRegistry;
        $this->em = $em;
		$this->passwordEncoder = $passwordEncoder;
		$this->router = $router;
		$this->slugger=$slugger;
		$this->container=$container;
    }

    public function supports(Request $request): ?bool
    {
        // continue ONLY if the current ROUTE matches the check ROUTE
        return $request->attributes->get('_route') === 'connect_facebook_check';
    }

    public function authenticate(Request $request): PassportInterface
    {
        $client = $this->clientRegistry->getClient('facebook');
        $accessToken = $this->fetchAccessToken($client);

        return new SelfValidatingPassport(
            new UserBadge($accessToken->getToken(), function() use ($accessToken, $client) {
                /** @var FacebookUser $facebookUser */
                $facebookUser = $client->fetchUserFromToken($accessToken);
				
                $email = $facebookUser->getEmail();

                // 1) have they logged in with Facebook before? Easy!
                $existingUser = $this->em->getRepository(Utilisateur::class)->findOneBy(['facebookId' => $facebookUser->getId()]);
				
                if ($existingUser) {
                    $user = $existingUser;
                }  else {
					// 2) do we have a matching user by email?
					$user = $this->em->getRepository(Utilisateur::class)->findOneBy(['email' => $email]);

					if (!$user) {
						/** @var User $user */
						$user = new Utilisateur();
						$user->setRoles(['ROLE_USER']);
                        $user->setNom($facebookUser->getLastName());
						$user->setPrenom($facebookUser->getFirstName());
						$user->setEmail($facebookUser->getEmail());
                        $user->setUsername($facebookUser->getLastName());
						
						$user->setPassword(
							$this->passwordEncoder->encodePassword(
								$user,
								random_bytes(10)
							)
						);
						
						$safeFilename = $this->slugger->slug(basename ($facebookUser->getPictureUrl()));
						$newFilename = $safeFilename.'-'.uniqid().".".Util::urlMimeType($facebookUser->getPictureUrl());
						
						$profileImage = file_get_contents($facebookUser->getPictureUrl());
						file_put_contents($this->container->getParameter('avatars_directory')."/".$newFilename,$profileImage);
						// instead of its contents
						$user->setProfileImage($newFilename);
					}
				}

                // 3) Maybe you just want to "register" them by creating
                // a User object
                $user->setFacebookId($facebookUser->getId());
        
				$this->em->persist($user);
				$this->em->flush();

				return $user;
            })
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // change "app_homepage" to some route in your app
        $targetUrl = $this->router->generate('recherche');

        return new RedirectResponse($targetUrl);
    
        // or, on success, let the request continue to be handled by the controller
        //return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $message = strtr($exception->getMessageKey(), $exception->getMessageData());

        return new Response($message, Response::HTTP_FORBIDDEN);
    }
}