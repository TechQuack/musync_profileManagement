<?php

namespace App\Controller;

use App\Entity\Parameters;
use App\Entity\Picture;
use App\Repository\PictureRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class PictureController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager,
                                private readonly PictureRepository $pictureRepository,
                                private readonly UserRepository $userRepository
    )
    {}

    #[Route('/picture/{picId}/getPicture', name: 'app_picture_get_picture', methods: ['GET'])]
    public function getPicture(int $picId) : Response
    {
        $picture = $this->pictureRepository->findOneBy(['id' => $picId]);
        if($picture == null) {
            return new Response("picture not found", Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse(["picture" => $picture], Response::HTTP_OK);
    }

    #[Route('/picture/{userId}/getProfilePicture', name: 'app_picture_get_profile_picture', methods: ['GET'])]
    public function getProfilePicture(int $userId) : Response
    {
        $user = $this->userRepository->findOneBy(['id' => $userId]);
        if($user == null) {
            return new Response("user", Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse(["picture" => $user->getProfile()->getProfilePicture()], Response::HTTP_OK);
    }

    #[Route('/picture/{userId}/getUserPictures', name: 'app_picture_get_user_pictures', methods: ['GET'])]
    public function getUserPictures(int $userId) : Response
    {
        $user = $this->userRepository->findOneBy(['id' => $userId]);
        if($user == null) {
            return new Response("user", Response::HTTP_NOT_FOUND);
        }
        /** @var ArrayCollection<int, Picture> $picturesList */
        $picturesList = new ArrayCollection();
        foreach ($user->getProfile()->getPictures() as $picture) {
            $picturesList->add($picture);
        }
        return new JsonResponse(["picture" => $picturesList], Response::HTTP_OK);
    }

    #[Route('/picture/postPicture', name: 'app_picture_post_profile_picture', methods: ['POST'])]
    public function postProfilePicture(Request $request, SluggerInterface $slugger) : Response
    {
        $picFile = $request->files->get("picture");
        if($picFile == null) {
            return new Response("picture file not found", Response::HTTP_NOT_FOUND);
        }
        $originalFilename = pathinfo($picFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$picFile->guessExtension();
        try {
            $picFile->move(Parameters::FILE_DIRECTORY, $newFilename);
        } catch (FileException $e) {

        }
        $userParameter = $request->request->get('userId');
        $user = $this->userRepository->findOneBy(["id" => $userParameter]);
        if($user == null) {
            return new Response("user not found", Response::HTTP_NOT_FOUND);
        }
        $profile = $user->getProfile();
        $picture = new Picture();
        $picture->setName($originalFilename);
        $picture->setLink(Parameters::FILE_DIRECTORY . $newFilename);
        $picture->setPostedDate(new \DateTime());
        $picture->setProfile($profile);
        $user->getProfile()->setProfilePicture($picture);
        return new JsonResponse(["picture" => $newFilename], Response::HTTP_OK);
    }
}