<?php

namespace App\NotificationContext\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\UserManagementContext\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

#[ApiResource]
#[ORM\Entity]
class NotificationSettings
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private UuidInterface $id;

    #[ORM\ManyToOne(targetEntity: User::class)] // Assuming User is the linked entity
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\Column(type: 'boolean')]
    private bool $emailNotificationsEnabled;

    #[ORM\Column(type: 'boolean')]
    private bool $smsNotificationsEnabled;

    #[ORM\Column(type: 'boolean')]
    private bool $pushNotificationsEnabled;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $updatedAt;

    public function __construct() {
        $this->id = Uuid::uuid4(); // Generate a new UUID
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    // Getters and Setters...

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function isEmailNotificationsEnabled(): bool
    {
        return $this->emailNotificationsEnabled;
    }

    public function setEmailNotificationsEnabled(bool $emailNotificationsEnabled): self
    {
        $this->emailNotificationsEnabled = $emailNotificationsEnabled;
        return $this;
    }

    public function isSmsNotificationsEnabled(): bool
    {
        return $this->smsNotificationsEnabled;
    }

    public function setSmsNotificationsEnabled(bool $smsNotificationsEnabled): self
    {
        $this->smsNotificationsEnabled = $smsNotificationsEnabled;
        return $this;
    }

    public function isPushNotificationsEnabled(): bool
    {
        return $this->pushNotificationsEnabled;
    }

    public function setPushNotificationsEnabled(bool $pushNotificationsEnabled): self
    {
        $this->pushNotificationsEnabled = $pushNotificationsEnabled;
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
}
