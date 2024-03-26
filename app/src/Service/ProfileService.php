<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class ProfileService
{
    public function __construct(private readonly EntityManagerInterface $entityManager
    )
    {}

    /**
     * isProfilePrivate : indicates if user profile is private
     * @param User $user
     * @return bool
     */
    public function isProfilePrivate(User $user) : bool
    {
        return $user->getProfile()->isPrivate();
    }

    /**
     * isProfileCertified : indicates if user profile is certified
     * @param User $user
     * @return bool
     */
    public function isProfileCertified(User $user) : bool
    {
        return $user->getProfile()->isCertified();
    }

    /**
     * getProfileDescription : returns user profile description
     * @param User $user
     * @return string
     */
    public function getProfileDescription(User $user) : string
    {
        return $user->getProfile()->getDescription();
    }

    /**
     * getAcceptedAgeGap : returns accepted age gap for user
     * @param User $user
     * @return int
     */
    public function getAcceptedAgeGap(User $user) : int
    {
        return $user->getProfile()->getAcceptedAgeGap();
    }

    /**
     * getAcceptedDistance : returns accepted distance for user
     * @param User $user
     * @return int
     */
    public function getAcceptedDistance(User $user) : int
    {
        return $user->getProfile()->getAcceptedDistance();
    }

    /**
     * getTargetedGender : returns user targeted gender
     * @param User $user
     * @return string
     */
    public function getTargetedGender(User $user) : string
    {
        return $user->getProfile()->getTargetedGender();
    }

    /**
     * getFavoriteMusician : returns user favorite musician
     * @param User $user
     * @return string
     */
    public function getFavoriteMusician(User $user) : string
    {
        return $user->getProfile()->getFavoriteMusician();
    }

    /**
     * getFavoriteMusic : returns user favorite music
     * @param User $user
     * @return string
     */
    public function getFavoriteMusic(User $user) : string
    {
        return $user->getProfile()->getFavoriteMusic();
    }

    /**
     * getFavoriteMusicStyle : returns user favorite music style
     * @param User $user
     * @return string
     */
    public function getFavoriteMusicStyle(User $user) : string
    {
        return $user->getProfile()->getFavoriteMusicStyle();
    }

    /**
     * setProfilePrivate : updates privacy of user profile
     * @param User $user
     * @param bool $private
     * @return void
     */
    public function setProfilePrivate(User $user, bool $private) : void
    {
        $user->getProfile()->setPrivate($private);
        $this->entityManager->persist($user->getProfile());
        $this->entityManager->flush();
    }

    /**
     * setProfileCertified : updates profile certification
     * @param User $user
     * @param bool $certified
     * @return void
     */
    public function setProfileCertified(User $user, bool $certified) : void
    {
        $user->getProfile()->setCertified($certified);
        $this->entityManager->persist($user->getProfile());
        $this->entityManager->flush();
    }

    /**
     * setProfileDescription : updates user profile description
     * @param User $user
     * @param string $description
     * @return void
     */
    public function setProfileDescription(User $user, string $description) : void
    {
        $user->getProfile()->setDescription($description);
        $this->entityManager->persist($user->getProfile());
        $this->entityManager->flush();
    }

    /**
     * setAcceptedAgeGap : updates user accepted age gap
     * @param User $user
     * @param int $ageGap
     * @return void
     */
    public function setAcceptedAgeGap(User $user, int $ageGap) : void
    {
        $user->getProfile()->setAcceptedAgeGap($ageGap);
        $this->entityManager->persist($user->getProfile());
        $this->entityManager->flush();
    }

    /**
     * setAcceptedDistance : updates user accepted distance
     * @param User $user
     * @param int $distance
     * @return void
     */
    public function setAcceptedDistance(User $user, int $distance) : void
    {
        $user->getProfile()->setAcceptedAgeGap($distance);
        $this->entityManager->persist($user->getProfile());
        $this->entityManager->flush();
    }

    /**
     * setTargetedGender : updates user targeted gender
     * @param User $user
     * @param string $gender
     * @return void
     */
    public function setTargetedGender(User $user, string $gender) : void
    {
        $user->getProfile()->setTargetedGender($gender);
        $this->entityManager->persist($user->getProfile());
        $this->entityManager->flush();
    }

    /**
     * setFavoriteMusician : updates user favorite musician
     * @param User $user
     * @param string $musician
     * @return void
     */
    public function setFavoriteMusician(User $user, string $musician) : void
    {
        $user->getProfile()->setFavoriteMusician($musician);
        $this->entityManager->persist($user->getProfile());
        $this->entityManager->flush();
    }

    /**
     * setFavoriteMusic : updates user favorite music
     * @param User $user
     * @param string $music
     * @return void
     */
    public function setFavoriteMusic(User $user, string $music) : void
    {
        $user->getProfile()->setFavoriteMusic($music);
        $this->entityManager->persist($user->getProfile());
        $this->entityManager->flush();
    }

    /**
     * setFavoriteMusicStyle : updates user favorite music style
     * @param User $user
     * @param string $style
     * @return void
     */
    public function setFavoriteMusicStyle(User $user, string $style) : void
    {
        $user->getProfile()->setFavoriteMusicStyle($style);
        $this->entityManager->persist($user->getProfile());
        $this->entityManager->flush();
    }
}