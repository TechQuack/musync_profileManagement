<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfileRepository::class)]
class Profile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'profile', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $associatedUser = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Picture $profilePicture = null;

    #[ORM\OneToMany(targetEntity: Picture::class, mappedBy: 'profile', orphanRemoval: true)]
    private Collection $pictures;

    #[ORM\Column]
    private ?bool $private = null;

    #[ORM\Column]
    private ?bool $certified = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $acceptedAgeGap = null;

    #[ORM\Column]
    private ?int $acceptedDistance = null;

    #[ORM\Column(length: 255)]
    private ?string $targetedGender = null;

    #[ORM\Column(length: 255)]
    private ?string $favoriteMusician = null;

    #[ORM\Column(length: 255)]
    private ?string $favoriteMusic = null;

    #[ORM\Column(length: 255)]
    private ?string $favoriteMusicStyle = null;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAssociatedUser(): ?User
    {
        return $this->associatedUser;
    }

    public function setAssociatedUser(User $associatedUser): static
    {
        $this->associatedUser = $associatedUser;

        return $this;
    }

    public function getProfilePicture(): ?Picture
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(?Picture $profilePicture): static
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }

    /**
     * @return Collection<int, Picture>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): static
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures->add($picture);
            $picture->setProfile($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): static
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getProfile() === $this) {
                $picture->setProfile(null);
            }
        }

        return $this;
    }

    public function isPrivate(): ?bool
    {
        return $this->private;
    }

    public function setPrivate(bool $private): static
    {
        $this->private = $private;

        return $this;
    }

    public function isCertified(): ?bool
    {
        return $this->certified;
    }

    public function setCertified(bool $certified): static
    {
        $this->certified = $certified;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAcceptedAgeGap(): ?int
    {
        return $this->acceptedAgeGap;
    }

    public function setAcceptedAgeGap(int $acceptedAgeGap): static
    {
        $this->acceptedAgeGap = $acceptedAgeGap;

        return $this;
    }

    public function getAcceptedDistance(): ?int
    {
        return $this->acceptedDistance;
    }

    public function setAcceptedDistance(int $acceptedDistance): static
    {
        $this->acceptedDistance = $acceptedDistance;

        return $this;
    }

    public function getTargetedGender(): ?string
    {
        return $this->targetedGender;
    }

    public function setTargetedGender(string $targetedGender): static
    {
        $this->targetedGender = $targetedGender;

        return $this;
    }

    public function getFavoriteMusician(): ?string
    {
        return $this->favoriteMusician;
    }

    public function setFavoriteMusician(string $favoriteMusician): static
    {
        $this->favoriteMusician = $favoriteMusician;

        return $this;
    }

    public function getFavoriteMusic(): ?string
    {
        return $this->favoriteMusic;
    }

    public function setFavoriteMusic(string $favoriteMusic): static
    {
        $this->favoriteMusic = $favoriteMusic;

        return $this;
    }

    public function getFavoriteMusicStyle(): ?string
    {
        return $this->favoriteMusicStyle;
    }

    public function setFavoriteMusicStyle(string $favoriteMusicStyle): static
    {
        $this->favoriteMusicStyle = $favoriteMusicStyle;

        return $this;
    }
}
