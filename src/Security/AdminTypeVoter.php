<?php

// src/Security/AdminTypeVoter.php
namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class AdminTypeVoter extends Voter
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $subject): bool
    {
        // Replace 'general' with the attribute you want to check
        return in_array($attribute, ['general', 'controleur', 'maintenancier'])
            && $subject instanceof User;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        // You know $subject is a User object, thanks to the supports method
        switch ($attribute) {
            case 'general':
                return $subject->getTypeAdmin() === 'general';
            case 'controleur':
                return $subject->getTypeAdmin() === 'controleur';
            case 'mecanicien':
                return $subject->getTypeAdmin() === 'mecanicien';
        }

        return false;
    }
}
