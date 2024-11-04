<?php

namespace App\BookingContext\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\UserManagementContext\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

#[ApiResource]
#[ORM\Entity]
class Calendar
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private UuidInterface $id;

    #[ORM\ManyToOne(targetEntity: User::class)] // Assuming User is the tradesperson
    #[ORM\JoinColumn(nullable: false)]
    private User $tradesperson;

    #[ORM\Column(type: 'date')]
    private \DateTimeInterface $startDate;

    #[ORM\Column(type: 'date')]
    private \DateTimeInterface $endDate;

    #[ORM\OneToMany(mappedBy: 'calendar', targetEntity: Availability::class)]
    private Collection $availabilities; // Add Doctrine Collection for availability

    public function __construct() {
        $this->id = Uuid::uuid4(); // Generate a new UUID
        $this->availabilities = new ArrayCollection();
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

    public function getStartDate(): \DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function getEndDate(): \DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;
        return $this;
    }

    public function getAvailabilities(): Collection
    {
        return $this->availabilities;
    }

    public function addAvailability(Availability $availability): self
    {
        if (!$this->availabilities->contains($availability)) {
            $this->availabilities[] = $availability;
            $availability->setCalendar($this);
        }

        return $this;
    }
}
