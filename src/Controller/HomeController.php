<?php

namespace App\Controller;

use App\Entity\Player;
use App\Entity\Team;
use App\Form\AddPlayerType;
use App\Form\AddTeamType;
use App\Repository\PlayerRepository;
use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(TeamRepository $teamRepository, PlayerRepository $playerRepository): Response
    {
        $addTeamForm = $this->createForm(AddTeamType::class, new Team(), [
            'action' => $this->generateUrl('app_add_team'),
        ]);

        $addPlayerForm = $this->createForm(AddPlayerType::class, new Player(), [
            'action' => $this->generateUrl('app_add_player'),
        ]);

        return $this->render('home/index.html.twig', [
            'teams' => $teamRepository->findWithPlayers(),
            'playersWithNoTeam' => $playerRepository->findWithNoTeam(),
            'addTeamForm' => $addTeamForm,
            'addPlayerForm' => $addPlayerForm,
        ]);
    }

    #[Route('/add/team', name: 'app_add_team', methods: ['POST'])]
    public function addTeam(): Response
    {
        return $this->redirectToRoute('app_home');
    }

    #[Route('/add/player', name: 'app_add_player', methods: ['POST'])]
    public function addPlayer(): Response
    {
        return $this->redirectToRoute('app_home');
    }
}
