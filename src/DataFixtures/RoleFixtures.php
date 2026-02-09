<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\RolePermission;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class RoleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $admin = new Role();
        $admin->setName('ADMIN')->setDescription('Administrateur');
        $manager->persist($admin);

        foreach (PermissionFixtures::PERMISSIONS as $permCode) {
            $rp = new RolePermission();
            $rp->setRole($admin);
            $rp->setPermission($this->getReference($permCode));
            $manager->persist($rp);
        }

        $auditor = new Role();
        $auditor->setName('AUDITOR')->setDescription('Auditeur');
        $manager->persist($auditor);

        foreach ([
            'PERM_AUDIT_CREATE',
            'PERM_AUDIT_ASSIGN',
            'PERM_REPORT_VALIDATE'
        ] as $permCode) {
            $rp = new RolePermission();
            $rp->setRole($auditor);
            $rp->setPermission($this->getReference($permCode));
            $manager->persist($rp);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [PermissionFixtures::class];
    }
}
