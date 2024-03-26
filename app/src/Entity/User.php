<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthdate = null;

    #[ORM\Column(length: 255)]
    private ?string $gender = null;

    #[ORM\OneToMany(targetEntity: UserSocialMedia::class, mappedBy: 'associatedUser', orphanRemoval: true)]
    private Collection $userSocialMedia;

    #[ORM\OneToOne(mappedBy: 'associatedUser', cascade: ['persist', 'remove'])]
    private ?Profile $profile = null;

    public function __construct()
    {
        $this->userSocialMedia = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): static
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return Collection<int, UserSocialMedia>
     */
    public function getUserSocialMedia(): Collection
    {
        return $this->userSocialMedia;
    }

    public function addUserSocialMedium(UserSocialMedia $userSocialMedium): static
    {
        if (!$this->userSocialMedia->contains($userSocialMedium)) {
            $this->userSocialMedia->add($userSocialMedium);
            $userSocialMedium->setAssociatedUser($this);
        }

        return $this;
    }

    public function removeUserSocialMedium(UserSocialMedia $userSocialMedium): static
    {
        if ($this->userSocialMedia->removeElement($userSocialMedium)) {
            // set the owning side to null (unless already changed)
            if ($userSocialMedium->getAssociatedUser() === $this) {
                $userSocialMedium->setAssociatedUser(null);
            }
        }

        return $this;
    }

    public function getProfile(): ?Profile
    {
        return $this->profile;
    }

    public function setProfile(Profile $profile): static
    {
        // set the owning side of the relation if necessary
        if ($profile->getAssociatedUser() !== $this) {
            $profile->setAssociatedUser($this);
        }

        $this->profile = $profile;

        return $this;
    }
}
