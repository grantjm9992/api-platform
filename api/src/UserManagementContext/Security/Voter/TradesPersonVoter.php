<?php

namespace App\UserManagementContext\Security\Voter;

use App\UserManagementContext\Entity\TradesPerson;
use App\UserManagementContext\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

final class TradesPersonVoter extends Voter
{
    public const EDIT = 'EDIT';
    public const CREATE = 'CREATE';

    protected function supports(string $attribute, mixed $subject): bool
    {

        return in_array($attribute, [self::EDIT, self::CREATE])
            && $subject instanceof TradesPerson;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        return match($attribute) {
            self::EDIT => $this->canEdit($token, $subject),
            self::CREATE => $this->canCreate($token, $subject),
            default => false,
        };
    }

    private function canEdit(TokenInterface $token, mixed $subject): bool
    {
        return $this->isSelf($token, $subject);
    }

    private function canCreate(TokenInterface $token, mixed $subject): bool
    {
        return $this->isSelf($token, $subject);
    }

    private function isSelf(TokenInterface $token, User $user): bool
    {
        return $token->getUser()->getId() === $user->getId();
    }


}
