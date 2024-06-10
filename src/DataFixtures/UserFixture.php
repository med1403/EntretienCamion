<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface; // Import the new interface

class UserFixture extends Fixture 
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Utilisateur 1
        $admin1 = new User();
        $admin1->setUsername('admin1');
        $admin1->setRoles(['ROLE_ADMIN']);
        
        // Hash the password and set it to the user
        $hashedPassword1 = $this->passwordHasher->hashPassword($admin1, 'admin1');
        $admin1->setPassword($hashedPassword1);

        $manager->persist($admin1);

        // Utilisateur 2
        $admin2 = new User();
        $admin2->setUsername('admin2');
        $admin2->setRoles(['ROLE_ADMIN']);
        
        // Hash the password and set it to the user
        $hashedPassword2 = $this->passwordHasher->hashPassword($admin2, 'admin2');
        $admin2->setPassword($hashedPassword2);

        $manager->persist($admin2);

        $manager->flush();
    }
}

