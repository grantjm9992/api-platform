<?php

namespace App\UserManagementContext\Repository;

use App\UserManagementContext\Entity\TradesPerson;

interface TradesPersonRepositoryInterface
{
    public function save(TradesPerson $tradesPerson): void;

    public function findByUser(string $userId): ?TradesPerson;
}
