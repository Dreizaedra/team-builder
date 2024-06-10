<?php

namespace App\Twig\Components;

use App\Entity\Player;
use Doctrine\ORM\PersistentCollection;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class Team
{
    public ?string $name = null;

    /**
     * @var PersistentCollection<int, Team>|array<int, Player>
     */
    public PersistentCollection|array $players;
}
