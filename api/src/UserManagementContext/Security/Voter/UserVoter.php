<?php

namespace App\UserManagementContext\Security\Voter;

use App\UserManagementContext\Entity\User;
use App\UserManagementContext\Security\f;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

final class UserVoter extends Voter
{
    const VIEW = 'user_view';
    const EDIT = 'user_edit';

    protected function supports($attribute, $subject): bool
    {
        return in_array($attribute, [self::VIEW, self::EDIT])
            && $subject instanceof User;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        if (!$subject instanceof User) {
            return true;
        }

        return match ($attribute) {
            self::VIEW => $this->canView(
                $token,
                $subject,
            ),
            self::EDIT => $this->canEdit(
                $token,
                $subject,
            ),
            default => false,
        };
    }

    private function canView(
        TokenInterface $token,
        $subject,
    ): bool {
        if ($subject->getId() !== $token->getUser()->getId()) {
            return false;
        }
        return true;
    }

    private function canEdit(
        TokenInterface $token,
        $subject,
    ): bool {
        if (in_array('ROLE_ADMIN', $token->getRoleNames())) {
            return true;
        }

        if ($subject->getId() !== $token->getUser()->getId()) {
            return false;
        }

        return true;
    }
}
