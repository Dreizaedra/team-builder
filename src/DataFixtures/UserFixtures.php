<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('admin')
            // Password: admin
            ->setPassword('$2y$10$LRjmgRnaV28COPXqdzvyteZJfy0s44mwhy2zGNS2yLTk/qWj7T.d6')
            ->setEmail('admin@admin.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPreferredLanguage($this->getReference('language1'))
        ;

        $manager->persist($user);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            LanguageFixtures::class,
        ];
    }
}
