<?php

namespace App\DataFixtures;

use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TeamFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $team1 = new Team();
        $team1->setName('Team A');

        $team2 = new Team();
        $team2->setName('Team B');

        $manager->persist($team1);
        $manager->persist($team2);

        $manager->flush();

        $this->setReference('team1', $team1);
        $this->setReference('team2', $team2);
    }
}
