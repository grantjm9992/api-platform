<?php

namespace App\ReviewContext\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\UserManagementContext\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

#[ApiResource]
#[ORM\Entity]
class Review
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private UuidInterface $id;

    #[ORM\ManyToOne(targetEntity: User::class)] // Assuming User is the reviewer
    #[ORM\JoinColumn(nullable: false)]
    private User $reviewer;

    #[ORM\ManyToOne(targetEntity: User::class)] // Assuming User is the reviewee (tradesperson)
    #[ORM\JoinColumn(nullable: false)]
    private User $reviewee;

    #[ORM\Column(type: 'text')]
    private string $comment; // Review comment

    #[ORM\Column(type: 'integer')]
    private int $rating; // Rating out of 5

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

    public function getReviewer(): User
    {
        return $this->reviewer;
    }

    public function setReviewer(User $reviewer): self
    {
        $this->reviewer = $reviewer;
        return $this;
    }

    public function getReviewee(): User
    {
        return $this->reviewee;
    }

    public function setReviewee(User $reviewee): self
    {
        $this->reviewee = $reviewee;
        return $this;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;
        return $this;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;
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
