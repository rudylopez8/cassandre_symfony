<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

final class PermissionVoter extends Voter
{
    protected function supports(string $attribute, mixed $subject): bool
    {
        // On ne gère QUE les permissions métier
        return str_starts_with($attribute, 'PERM_');
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        $role = $user->getRole();
        if (!$role) {
            return false;
        }

        foreach ($role->getRolePermissions() as $rolePermission) {
            if ($rolePermission->getPermission()->getCode() === $attribute) {
                return true;
            }
        }

        return false;
    }
}
