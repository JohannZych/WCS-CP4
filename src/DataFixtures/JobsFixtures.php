<?php

namespace App\DataFixtures;

use App\Entity\Jobs;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Monolog\DateTimeImmutable;

class JobsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 100; $i++) {
            $jobs = new Jobs();
            $jobs->setTitle($faker->randomElement([
                'Développeur PHP',
                'Développeur Symfony',
                'Développeur Javascript',
                'Développeur FullStack',
                'Développeur React',
                'Data Analyst',
                'Développeur NodeJs']));
            $jobs->setEntreprise($faker->company());
            $jobs->setTypeJob($faker->randomElement([
                'CDI',
                'CDD',
                'Stage',
                'Alternance'
            ]));
            $jobs->setCreatedAt(new DateTimeImmutable('now'));
            $jobs->setContent($faker->sentence(3));
            $jobs->setCity('Bordeaux');
            $jobs->setUrl($faker->url());
            $manager->persist($jobs);
        }
        $manager->flush();
    }
}
