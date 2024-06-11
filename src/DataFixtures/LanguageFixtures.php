<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LanguageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $language1 = new Language();
        $language1->setName('Français')
            ->setCode('fr');

        $language2 = new Language();
        $language2->setName('English')
            ->setCode('en');

        $language3 = new Language();
        $language3->setName('Deutsch')
            ->setCode('de');

        $language4 = new Language();
        $language4->setName('中文')
            ->setCode('zh');

        $manager->persist($language1);
        $manager->persist($language2);
        $manager->persist($language3);
        $manager->persist($language4);

        $manager->flush();

        $this->setReference('language1', $language1);
        $this->setReference('language2', $language2);
        $this->setReference('language3', $language3);
        $this->setReference('language4', $language4);
    }
}
