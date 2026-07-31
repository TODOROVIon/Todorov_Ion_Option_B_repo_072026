<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}
    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setFirstName('Aurelie');
        $admin->setLastName('Doe');
        $admin->setEmail('aurelie.doe@example.com');
        $admin->setPassword($this->hasher->hashPassword($admin,'admin123'));
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setApiAccess(true);
        $manager->persist($admin);

        $user = new User();
        $user->setFirstName('John');
        $user->setLastName('Doe');
        $user->setEmail('john.doe@example.com');
        $user->setPassword($this->hasher->hashPassword($user, 'user123'));
        $user->setRoles(['ROLE_USER']);
        $user->setApiAccess(true);
        $manager->persist($user);

        $manager->flush();
    }
}
