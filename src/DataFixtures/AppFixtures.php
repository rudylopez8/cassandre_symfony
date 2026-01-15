<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création de 10 clients de test
        for ($i = 1; $i <= 10; $i++) {
            $client = new Client();
            
            // Nom > 5 caractères et email valide
            $client->setNom('Client ' . $i)
                   ->setMail('client' . $i . '@exemple.com');

            $manager->persist($client);
        }

        $manager->flush();
    }
}