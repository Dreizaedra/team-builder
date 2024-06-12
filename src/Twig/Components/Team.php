<?php

namespace App\Twig\Components;

use App\Entity\Player;
use App\Entity\Team as TeamEntity;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveListener;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentToolsTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class Team
{
    use DefaultActionTrait;
    use ComponentToolsTrait;

    #[LiveProp]
    public ?TeamEntity $team = null;

    public function __construct(private readonly EntityManagerInterface $em, private readonly PlayerRepository $playerRepository)
    {
    }

    /**
     * @return Player[]|void[]
     */
    #[LiveListener('player:delete')]
    #[LiveListener('team:delete')]
    public function getPlayers(): array
    {
        if (!is_null($this->team)) {
            return $this->team->getPlayers()->toArray();
        }

        return $this->playerRepository->findWithNoTeam();
    }

    #[LiveAction]
    public function deleteTeam(): void
    {
        $this->em->remove($this->team);
        $this->em->flush();

        $this->emit('team:delete');
    }

    #[LiveAction]
    public function deletePlayer(#[LiveArg('playerId')] int $id): void
    {
        /** @var Player $player */
        $player = $this->playerRepository->find($id);

        if (is_null($this->team)) {
            $this->em->remove($player);
        } else {
            $player->removeTeam($this->team);
            $this->em->persist($player);
        }

        $this->em->flush();

        $this->emit('player:delete');
    }
}
