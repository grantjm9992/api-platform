<?php

namespace App\PaymentContext\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\PaymentContext\Enum\SubscriptionStatusEnum;
use App\UserManagementContext\Entity\TradesPerson;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

#[ApiResource]
#[ORM\Entity]
class Subscription
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private UuidInterface $id;

    #[ORM\ManyToOne(targetEntity: TradesPerson::class, inversedBy: 'subscriptions')]
    private TradesPerson $tradesPerson;

    #[ORM\ManyToOne(targetEntity: SubscriptionPlan::class)]
    private SubscriptionPlan $subscriptionPlan;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTime $startDate;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTime $endDate;

    #[ORM\Embedded]
    private SubscriptionStatusEnum $subscriptionStatus;

    #[ORM\Column(type: 'boolean')]
    private bool $autoRenew;
}
