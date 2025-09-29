<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'users')]
class User {
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private ?int $id = null;
    #[ORM\Column]
    #[Assert\NotBlank]
    private ?string $username = null;
    #[ORM\Column]
    #[Assert\NotBlank]
    private ?string $email = null;
    #[ORM\Column]
    #[Assert\NotBlank]
    private ?string $password = null;
    #[ORM\Column]
    private ?UserRole $userRole = null;
    #[ORM\Column]
    private ?DateTimeImmutable $createdAt = null;
    #[ORM\Column]
    private ?DateTimeImmutable $updatedAt = null;
    #[ORM\Column]
    private ?bool $isActive = null;
    #[ORM\Column]
    private ?bool $isBanned = null;

    public function __construct() {

    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getUsername(): ?string {
        return $this->username;
    }

    public function setUsername(?string $username): User {
        $this->username = $username;
        return $this;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $email): User {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): ?string {
        return $this->password;
    }

    public function setPassword(?string $password): User {
        $this->password = $password;
        return $this;
    }

    public function getUserRole(): ?UserRole {
        return $this->userRole;
    }

    public function setUserRole(?UserRole $userRole): User {
        $this->userRole = $userRole;
        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTimeImmutable $createdAt): User {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?DateTimeImmutable {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeImmutable $updatedAt): User {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getIsActive(): ?bool {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): User {
        $this->isActive = $isActive;
        return $this;
    }

    public function getIsBanned(): ?bool {
        return $this->isBanned;
    }

    public function setIsBanned(?bool $isBanned): User {
        $this->isBanned = $isBanned;
        return $this;
    }

}
