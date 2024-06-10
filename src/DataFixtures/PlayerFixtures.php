<?php

namespace App\DataFixtures;

use App\Entity\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PlayerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $player1 = new Player();
        $player1->setFirstName('Jean')
            ->setLastName('Dujardin')
            ->addTeam($this->getReference('team1'))
            ->addTeam($this->getReference('team2'));

        $player2 = new Player();
        $player2->setFirstName('Brad')
            ->setLastName('Pitt')
            ->addTeam($this->getReference('team1'));

        $player3 = new Player();
        $player3->setFirstName('Bruce')
            ->setLastName('Willis')
            ->addTeam($this->getReference('team2'));

        $player4 = new Player();
        $player4->setFirstName('Angelina')
            ->setLastName('Jolie')
            ->addTeam($this->getReference('team2'));

        $player5 = new Player();
        $player5->setFirstName('John')
            ->setLastName('Doe');

        $manager->persist($player1);
        $manager->persist($player2);
        $manager->persist($player3);
        $manager->persist($player4);
        $manager->persist($player5);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TeamFixtures::class,
        ];
    }
}
