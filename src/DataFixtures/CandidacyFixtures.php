<?php

namespace App\DataFixtures;

use App\Entity\Candidacy;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Monolog\DateTimeImmutable;

class CandidacyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 20; $i++) {
            $candidacy = new Candidacy();
            $candidacy->setNameEntreprise($faker->company());
            $candidacy->setCreatedAt(new DateTimeImmutable('now'));
            $candidacy->setContent($faker->sentence());
            $manager->persist($candidacy);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
