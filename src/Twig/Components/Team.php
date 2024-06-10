<?php

namespace App\Twig\Components;

use Doctrine\ORM\PersistentCollection;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class Team
{
    public ?string $name = null;
    public PersistentCollection|array $players;
}
