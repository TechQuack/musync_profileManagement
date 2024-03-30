<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ProfileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends AbstractController
{

    public function __construct(private readonly EntityManagerInterface $entityManager,
                                private readonly ProfileRepository $profileRepository,
    )
    {}

    #[Route('/profile/{userId}/getPrivate', name: 'app_profile_get_private', methods: ['GET'])]
    public function getPrivate(int $userId) : Response
    {
        $profile = $this->profileRepository->findOneBy(["associatedUser" => $userId]);
        if($profile == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse(["private" => $profile->isPrivate()], Response::HTTP_OK);
    }

    #[Route('/profile/{userId}/getDescription', name: 'app_profile_get_description', methods: ['GET'])]
    public function getDescription(int $userId) : Response
    {
        $profile = $this->profileRepository->findOneBy(["associatedUser" => $userId]);
        if($profile == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse(["description" => $profile->getDescription()], Response::HTTP_OK);
    }

    #[Route('/profile/{userId}/getAcceptedAgeGap', name: 'app_profile_get_accepted_age_gap', methods: ['GET'])]
    public function getAccepetedAgeGap(int $userId) : Response
    {
        $profile = $this->profileRepository->findOneBy(["associatedUser" => $userId]);
        if($profile == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse(["accepted_age_gap" => $profile->getAcceptedAgeGap()], Response::HTTP_OK);
    }

    #[Route('/profile/{userId}/getAcceptedDistance', name: 'app_profile_get_accepted_distance', methods: ['GET'])]
    public function getAcceptedDistance(int $userId) : Response
    {
        $profile = $this->profileRepository->findOneBy(["associatedUser" => $userId]);
        if($profile == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse(["accepted_distance" => $profile->getAcceptedDistance()], Response::HTTP_OK);
    }

    #[Route('/profile/{userId}/getTargetGender', name: 'app_profile_get_targeted_gender', methods: ['GET'])]
    public function getTargetedGender(int $userId) : Response
    {
        $profile = $this->profileRepository->findOneBy(["associatedUser" => $userId]);
        if($profile == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse(["targeted_gender" => $profile->getTargetedGender()], Response::HTTP_OK);
    }

    #[Route('/profile/{userId}/getFavoriteMusician', name: 'app_profile_get_favorite_musician', methods: ['GET'])]
    public function getFavoriteMusician(int $userId) : Response
    {
        $profile = $this->profileRepository->findOneBy(["associatedUser" => $userId]);
        if($profile == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse(["favorite_musician" => $profile->getFavoriteMusician()], Response::HTTP_OK);
    }

    #[Route('/profile/{userId}/getFavoriteMusic', name: 'app_profile_get_favorite_music', methods: ['GET'])]
    public function getFavoriteMusic(int $userId) : Response
    {
        $profile = $this->profileRepository->findOneBy(["associatedUser" => $userId]);
        if($profile == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse(["favorite_music" => $profile->getFavoriteMusic()], Response::HTTP_OK);
    }

    #[Route('/profile/{userId}/getFavoriteStyle', name: 'app_profile_get_style', methods: ['GET'])]
    public function getFavoriteStyle(int $userId) : Response
    {
        $profile = $this->profileRepository->findOneBy(["associatedUser" => $userId]);
        if($profile == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse(["favorite_style" => $profile->getFavoriteMusicStyle()], Response::HTTP_OK);
    }

    #[Route('/profile/PostPrivate', name: 'app_profile_post_private', methods: ['POST'])]
    public function postPrivate(Request $request) : Response
    {
        $parameters = json_decode($request->getContent(), true);
        $profile = $this->profileRepository->findOneBy(["associatedUser" => $parameters['userId']]);
        if($profile == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        $profile->setPrivate($parameters['private']);
        return new JsonResponse(["certified" => $profile->isCertified()], Response::HTTP_OK);
    }

    #[Route('/profile/PostPrivate', name: 'app_profile_post_private', methods: ['POST'])]
    public function postCertified(Request $request) : Response
    {
        $parameters = json_decode($request->getContent(), true);
        $profile = $this->profileRepository->findOneBy(["associatedUser" => $parameters['userId']]);
        if($profile == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        $profile->setCertified($parameters['certified']);
        return new JsonResponse(["certified" => $profile->isCertified()], Response::HTTP_OK);
    }

    #[Route('/profile/PostDescription', name: 'app_profile_post_description', methods: ['POST'])]
    public function postDescription(Request $request) : Response
    {
        $parameters = json_decode($request->getContent(), true);
        $profile = $this->profileRepository->findOneBy(["associatedUser" => $parameters['userId']]);
        if($profile == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        $profile->setDescription($parameters['description']);
        return new JsonResponse(["description" => $profile->getDescription()], Response::HTTP_OK);
    }

    #[Route('/profile/PostAcceptedAgeGap', name: 'app_profile_post_accepted_age_gap', methods: ['POST'])]
    public function postAcceptedAgeGap(Request $request) : Response
    {
        $parameters = json_decode($request->getContent(), true);
        $profile = $this->profileRepository->findOneBy(["associatedUser" => $parameters['userId']]);
        if($profile == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        $profile->setAcceptedAgeGap($parameters['accepted_age_gap']);
        return new JsonResponse(["accepted_age_gap" => $profile->getAcceptedAgeGap()], Response::HTTP_OK);
    }

    #[Route('/profile/PostAcceptedDistance', name: 'app_profile_post_accepted_distance', methods: ['POST'])]
    public function postAcceptedDistance(Request $request) : Response
    {
        $parameters = json_decode($request->getContent(), true);
        $profile = $this->profileRepository->findOneBy(["associatedUser" => $parameters['userId']]);
        if($profile == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        $profile->setAcceptedDistance($parameters['accepted_distance']);
        return new JsonResponse(["accepted_distance" => $profile->getAcceptedDistance()], Response::HTTP_OK);
    }

    #[Route('/profile/PostTargetedGender', name: 'app_profile_post_targeted_gender', methods: ['POST'])]
    public function postTargetedGender(Request $request) : Response
    {
        $parameters = json_decode($request->getContent(), true);
        $profile = $this->profileRepository->findOneBy(["associatedUser" => $parameters['userId']]);
        if($profile == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        $profile->setTargetedGender($parameters['targeted_gender']);
        return new JsonResponse(["targeted_gender" => $profile->getTargetedGender()], Response::HTTP_OK);
    }

    #[Route('/profile/PostFavoriteMusician', name: 'app_profile_post_favorite_musician', methods: ['POST'])]
    public function postFavoriteMusician(Request $request) : Response
    {
        $parameters = json_decode($request->getContent(), true);
        $profile = $this->profileRepository->findOneBy(["associatedUser" => $parameters['userId']]);
        if($profile == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        $profile->setFavoriteMusician($parameters['favorite_musician']);
        return new JsonResponse(["favorite_musician" => $profile->getFavoriteMusician()], Response::HTTP_OK);
    }

    #[Route('/profile/PostFavoriteMusic', name: 'app_profile_post_favorite_music', methods: ['POST'])]
    public function postFavoriteMusic(Request $request) : Response
    {
        $parameters = json_decode($request->getContent(), true);
        $profile = $this->profileRepository->findOneBy(["associatedUser" => $parameters['userId']]);
        if($profile == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        $profile->setFavoriteMusic($parameters['favorite_music']);
        return new JsonResponse(["favorite_music" => $profile->getFavoriteMusic()], Response::HTTP_OK);
    }

    #[Route('/profile/PostFavoriteStyle', name: 'app_profile_post_favorite_style', methods: ['POST'])]
    public function postFavoriteStyle(Request $request) : Response
    {
        $parameters = json_decode($request->getContent(), true);
        $profile = $this->profileRepository->findOneBy(["associatedUser" => $parameters['userId']]);
        if($profile == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        $profile->setFavoriteMusicStyle($parameters['favorite_style']);
        return new JsonResponse(["favorite_style" => $profile->getFavoriteMusicStyle()], Response::HTTP_OK);
    }

}