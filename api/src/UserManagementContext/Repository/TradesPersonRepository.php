<?php

namespace App\UserManagementContext\Repository;

use App\UserManagementContext\Entity\TradesPerson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class TradesPersonRepository extends ServiceEntityRepository implements TradesPersonRepositoryInterface
{
    public function save(TradesPerson $tradesPerson): void
    {
        $this->_em->persist($tradesPerson);
        $this->_em->flush();
    }

    public function findByUser(string $userId): ?TradesPerson
    {
        return $this->createQueryBuilder('tp')
            ->andWhere('tp.user = :user')
            ->setParameter('user', $userId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
