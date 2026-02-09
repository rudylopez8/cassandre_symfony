<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admin@test.fr')
            ->setFirstName('Admin')
            ->setLastName('Root')
            ->setIsActive(true)
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTime())
            ->setRole(
                $manager->getRepository(\App\Entity\Role::class)
                    ->findOneBy(['name' => 'ADMIN'])
            );

        $admin->setPasswordHash(
            $this->hasher->hashPassword($admin, 'admin123')
        );

        $manager->persist($admin);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [RoleFixtures::class];
    }
}
