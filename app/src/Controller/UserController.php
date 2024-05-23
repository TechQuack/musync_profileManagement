<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{

    public function __construct(private readonly EntityManagerInterface $entityManager,
                                private readonly UserRepository $userRepository,
    )
    {}

    #[Route('/user/{userId}/getUserFromId', name: 'app_user_get_user_from_id', methods: ['GET'])]
    public function getUserFromId(int $userId) : Response
    {
        $user = $this->userRepository->findOneBy(["id" => $userId]);
        if($user == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        $profile = $user->getProfile();
        $userInformation = array();
        $userInformation["first_name"] = $user->getFirstName();
        $userInformation["last_name"] = $user->getLastName();
        $userInformation["email"] = $user->getEmail();
        $userInformation["birthdate"] = $user->getBirthdate()->format('d-m-y');
        $userInformation["gender"] = $user->getGender();
        $userInformation["private"] = $profile->isPrivate();
        $userInformation["certified"] = $profile->isCertified();
        $userInformation["description"] = $profile->getDescription();
        $userInformation["accepted_age_gap"] = $profile->getAcceptedAgeGap();
        $userInformation["accepted_distance"] = $profile->getAcceptedDistance();
        $userInformation["targeted_gender"] = $profile->getTargetedGender();
        $userInformation["favorite_musician"] = $profile->getFavoriteMusician();
        $userInformation["favorite_music"] = $profile->getFavoriteMusic();
        $userInformation["favorite_style"] = $profile->getFavoriteMusicStyle();
        return new JsonResponse($userInformation, Response::HTTP_OK);
    }

    #[Route('/user/{userId}/getFirstName', name: 'app_user_get_first_name', methods: ['GET'])]
    public function getFirstName(int $userId) : Response
    {
        $user = $this->userRepository->findOneBy(["user_id" => $userId]);
        if($user == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse(["first_name" => $user->getFirstName()], Response::HTTP_OK);
    }

    #[Route('/user/{userId}/getLastName', name: 'app_user_get_last_name', methods: ['GET'])]
    public function getLastName(int $userId) : Response
    {
        $user = $this->userRepository->findOneBy(["id" => $userId]);
        if($user == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse(["last_name" => $user->getLastName()], Response::HTTP_OK);
    }

    #[Route('/user/{userId}/getEmail', name: 'app_user_get_email', methods: ['GET'])]
    public function getEmail(int $userId) : Response
    {
        $user = $this->userRepository->findOneBy(["id" => $userId]);
        if($user == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse(["email" => $user->getEmail()], Response::HTTP_OK);
    }

    #[Route('/user/{userId}/getBirthdate', name: 'app_user_get_birthdate', methods: ['GET'])]
    public function getBirthdate(int $userId) : Response
    {
        $user = $this->userRepository->findOneBy(["id" => $userId]);
        if($user == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse(["birthdate" => $user->getBirthdate()], Response::HTTP_OK);
    }

    #[Route('/user/{userId}/getGender', name: 'app_user_get_gender', methods: ['GET'])]
    public function getGender(int $userId) : Response
    {
        $user = $this->userRepository->findOneBy(["id" => $userId]);
        if($user == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse(["gender" => $user->getGender()], Response::HTTP_OK);
    }

    #[Route('/user/{userId}/getSocialMedia', name: 'app_user_get_social_media', methods: ['GET'])]
    public function getSocialMedia(int $userId) : Response
    {
        $user = $this->userRepository->findOneBy(["id" => $userId]);
        if($user == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse(["private" => $user->getUserSocialMedia()], Response::HTTP_OK);
    }

    #[Route('/user/PostUser', name: 'app_user_post_user', methods: ['POST'])]
    public function postUser(Request $request) : Response
    {
        $parameters = json_decode($request->getContent(), true);
        $profile = new Profile();
        $profile->setPrivate($parameters['private']);
        $profile->setCertified($parameters['certified']);
        $profile->setFavoriteMusic($parameters['favorite_music']);
        $profile->setFavoriteMusician($parameters['favorite_musician']);
        $profile->setFavoriteMusicStyle($parameters['favorite_style']);
        $profile->setTargetedGender($parameters['targeted_gender']);
        $profile->setAcceptedDistance($parameters['accepted_distance']);
        $profile->setAcceptedAgeGap($parameters['accepted_age_gap']);
        $profile->setDescription($parameters['description']);
        $this->entityManager->persist($profile);
        $user = new User();
        $user->setFirstName($parameters['first_name']);
        $user->setLastName($parameters['last_name']);
        $user->setEmail($parameters['email']);
        $birthdate = \DateTime::createFromFormat('d/m/Y', $parameters['birthdate']);
        $user->setBirthdate($birthdate);
        $user->setGender($parameters['gender']);
        $user->setProfile($profile);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return new JsonResponse(["id" => $user->getId()], Response::HTTP_OK);
    }

    #[Route('/user/PostFirstName', name: 'app_user_post_firstname', methods: ['POST'])]
    public function postFirstName(Request $request) : Response
    {
        $parameters = json_decode($request->getContent(), true);
        $user = $this->userRepository->findOneBy(["id" => $parameters['userId']]);
        if($user == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        $user->setFirstName($parameters['first_name']);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return new JsonResponse(["first_name" => $user->getFirstName()], Response::HTTP_OK);
    }

    #[Route('/user/PostLastName', name: 'app_user_post_lastname', methods: ['POST'])]
    public function postLastName(Request $request) : Response
    {
        $parameters = json_decode($request->getContent(), true);
        $user = $this->userRepository->findOneBy(["id" => $parameters['userId']]);
        if($user == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        $user->setLastName($parameters['last_name']);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return new JsonResponse(["last_name" => $user->getLastName()], Response::HTTP_OK);
    }

    #[Route('/user/PostEmail', name: 'app_user_post_email', methods: ['POST'])]
    public function postEmail(Request $request) : Response
    {
        $parameters = json_decode($request->getContent(), true);
        $user = $this->userRepository->findOneBy(["id" => $parameters['userId']]);
        if($user == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        $user->setEmail($parameters['email']);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return new JsonResponse(["email" => $user->getEmail()], Response::HTTP_OK);
    }

    #[Route('/user/PostBirthdate', name: 'app_user_post_birthdate', methods: ['POST'])]
    public function postBirthdate(Request $request) : Response
    {
        $parameters = json_decode($request->getContent(), true);
        $user = $this->userRepository->findOneBy(["id" => $parameters['userId']]);
        if($user == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        $user->setBirthdate($parameters['birthdate']);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return new JsonResponse(["birthdate" => $user->getBirthdate()], Response::HTTP_OK);
    }

    #[Route('/user/PostGender', name: 'app_user_post_gender', methods: ['POST'])]
    public function postGender(Request $request) : Response
    {
        $parameters = json_decode($request->getContent(), true);
        $user = $this->userRepository->findOneBy(["id" => $parameters['userId']]);
        if($user == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        $user->setGender($parameters['gender']);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return new JsonResponse(["gender" => $user->getGender()], Response::HTTP_OK);
    }

}