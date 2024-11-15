<?php

namespace App\PaymentContext\Enum;

enum SubscriptionStatusEnum: string
{
    case ACTIVE = 'active';
    case EXPIRED = 'expired';
    case CANCELLED = 'cancelled';
}
