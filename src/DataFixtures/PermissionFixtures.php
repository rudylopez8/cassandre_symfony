<?php

namespace App\DataFixtures;

use App\Entity\Permission;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PermissionFixtures extends Fixture
{
    public const PERMISSIONS = [
        'PERM_USER_MANAGE',
        'PERM_AUDIT_CREATE',
        'PERM_AUDIT_ASSIGN',
        'PERM_AUDIT_VALIDATE',
        'PERM_REPORT_VALIDATE',
        'PERM_INVOICE_VIEW',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PERMISSIONS as $code) {
            $permission = new Permission();
            $permission->setCode($code);
            $permission->setDescription($code);

            $manager->persist($permission);
            $this->addReference($code, $permission);
        }

        $manager->flush();
    }
}
