<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $username = null;

    #[ORM\Column(length: 80)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    private ?bool $blocked = null;

    #[ORM\Column(length: 10)]
    private ?string $role = null;

    #[ORM\Column(length: 255)]
    private ?string $securityQuestion = null;

    #[ORM\Column(length: 255)]
    private ?string $securityResponse = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $passwordDate = null;

    /**
     * @var Collection<int, UsedPassword>
     */
    #[ORM\OneToMany(targetEntity: UsedPassword::class, mappedBy: 'user')]
    private Collection $usedPasswords;

    public function __construct()
    {
        $this->usedPasswords = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function isBlocked(): ?bool
    {
        return $this->blocked;
    }

    public function setBlocked(bool $blocked): static
    {
        $this->blocked = $blocked;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getSecurityQuestion(): ?string
    {
        return $this->securityQuestion;
    }

    public function setSecurityQuestion(string $securityQuestion): static
    {
        $this->securityQuestion = $securityQuestion;

        return $this;
    }

    public function getSecurityResponse(): ?string
    {
        return $this->securityResponse;
    }

    public function setSecurityResponse(string $securityResponse): static
    {
        $this->securityResponse = $securityResponse;

        return $this;
    }

    public function getPasswordDate(): ?\DateTime
    {
        return $this->passwordDate;
    }

    public function setPasswordDate(\DateTime $passwordDate): static
    {
        $this->passwordDate = $passwordDate;

        return $this;
    }

    /**
     * @return Collection<int, UsedPassword>
     */
    public function getUsedPasswords(): Collection
    {
        return $this->usedPasswords;
    }

    public function addUsedPassword(UsedPassword $usedPassword): static
    {
        if (!$this->usedPasswords->contains($usedPassword)) {
            $this->usedPasswords->add($usedPassword);
            $usedPassword->setUser($this);
        }

        return $this;
    }

    public function removeUsedPassword(UsedPassword $usedPassword): static
    {
        if ($this->usedPasswords->removeElement($usedPassword)) {
            // set the owning side to null (unless already changed)
            if ($usedPassword->getUser() === $this) {
                $usedPassword->setUser(null);
            }
        }

        return $this;
    }
}
