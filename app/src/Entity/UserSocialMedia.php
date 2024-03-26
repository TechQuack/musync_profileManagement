<?php

namespace App\Entity;

use App\Repository\UserSocialMediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserSocialMediaRepository::class)]
class UserSocialMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userSocialMedia')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $associatedUser = null;

    #[ORM\Column(length: 255)]
    private ?string $tokenAccount = null;

    #[ORM\Column]
    private ?bool $private = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?SocialMedia $socialMedia = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAssociatedUser(): ?User
    {
        return $this->associatedUser;
    }

    public function setAssociatedUser(?User $associatedUser): static
    {
        $this->associatedUser = $associatedUser;

        return $this;
    }

    public function getTokenAccount(): ?string
    {
        return $this->tokenAccount;
    }

    public function setTokenAccount(string $tokenAccount): static
    {
        $this->tokenAccount = $tokenAccount;

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

    public function getSocialMedia(): ?SocialMedia
    {
        return $this->socialMedia;
    }

    public function setSocialMedia(?SocialMedia $socialMedia): static
    {
        $this->socialMedia = $socialMedia;

        return $this;
    }
}
