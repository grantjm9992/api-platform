<?php

namespace App\UserManagementContext\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\UserManagementContext\Controller\User\ResetPasswordAction;
use App\UserManagementContext\Repository\UserRepository;
use App\UserManagementContext\State\Processor\User\CreateUserProcessor;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ApiResource(
    operations: [
        new Get(
            security: "is_granted('user_view', object)",
        ),
        new GetCollection(
            security: "is_granted('ROLE_ADMIN')",
        ),
        new Post(
            processor: CreateUserProcessor::class,
        ),
        new Patch(
            security: "is_granted('user_edit', object)",
        ),
        new Post(
            uriTemplate: 'user/reset_password',
            controller: ResetPasswordAction::class,
        )
    ]
)]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'api_user')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private UuidInterface $id;

    #[ORM\Column(type: 'string', unique: true)]
    private string $email;

    #[ORM\Column(type: 'string')]
    private string $password;

    #[ORM\Column(type: 'string')]
    private string $role;

    #[ORM\OneToOne(inversedBy: 'user', targetEntity: TradesPerson::class)]
    private ?TradesPerson $tradesPerson;

    #[ORM\OneToOne(inversedBy: 'user', targetEntity: Profile::class)]
    private ?Profile $profile;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $updatedAt;

    public function __construct() {
        $this->id = Uuid::uuid4();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;
        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getRoles(): array
    {
        return [$this->role];
    }

    public function getTradesPerson(): ?TradesPerson
    {
        return $this->tradesPerson;
    }

    public function setTradesPerson(?TradesPerson $tradesPerson): void
    {
        $this->tradesPerson = $tradesPerson;
    }

    public function getProfile(): ?Profile
    {
        return $this->profile;
    }

    public function setProfile(?Profile $profile): void
    {
        $this->profile = $profile;
    }

    public function getSalt() {}

    public function eraseCredentials() {}

    public function getUserIdentifier(): string
    {
        return $this->id;
    }
}
