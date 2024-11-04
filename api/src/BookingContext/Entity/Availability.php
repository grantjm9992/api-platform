<?php

namespace App\BookingContext\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\UserManagementContext\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

#[ApiResource]
#[ORM\Entity]
class Availability
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private UuidInterface $id;

    #[ORM\ManyToOne(targetEntity: User::class)] // Assuming User is the tradesperson
    #[ORM\JoinColumn(nullable: false)]
    private User $tradesperson;

    #[ORM\Column(type: 'date')]
    private \DateTimeInterface $date;

    #[ORM\Column(type: 'time')]
    private \DateTimeInterface $startTime;

    #[ORM\Column(type: 'time')]
    private \DateTimeInterface $endTime;

    #[ORM\Column(type: 'string')]
    private string $status;

    public function __construct() {
        $this->id = Uuid::uuid4(); // Generate a new UUID
    }

    // Getters and Setters...

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getTradesperson(): User
    {
        return $this->tradesperson;
    }

    public function setTradesperson(User $tradesperson): self
    {
        $this->tradesperson = $tradesperson;
        return $this;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getStartTime(): \DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;
        return $this;
    }

    public function getEndTime(): \DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }
}
