<?php

namespace App\Controller;

use App\Entity\Player;
use App\Entity\Team;
use App\Form\AddPlayerType;
use App\Form\AddTeamType;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class HomeController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $em, private readonly TranslatorInterface $translator)
    {
    }

    #[Route('/', name: 'app_home', methods: ['GET'])]
    #[Template('home/index.html.twig')]
    public function index(TeamRepository $teamRepository): Response
    {
        $addTeamForm = $this->createForm(AddTeamType::class, new Team(), [
            'action' => $this->generateUrl('app_add_team'),
        ]);

        $addPlayerForm = $this->createForm(AddPlayerType::class, new Player(), [
            'action' => $this->generateUrl('app_add_player'),
        ]);

        return $this->render('home/index.html.twig', [
            'teams' => $teamRepository->findWithPlayers(),
            'addTeamForm' => $addTeamForm,
            'addPlayerForm' => $addPlayerForm,
        ]);
    }

    #[Route('/team/add', name: 'app_add_team', methods: ['POST'])]
    public function addTeam(Request $request): Response
    {
        $form = $this->createForm(AddTeamType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $team = $form->getData();
            $this->em->persist($team);
            $this->em->flush();

            $this->addFlash('success', $this->translator->trans('app.flash.success.add_team'));
        }

        return $this->redirectToRoute('app_home');
    }

    #[Route('/player/add', name: 'app_add_player', methods: ['POST'])]
    public function addPlayer(Request $request): Response
    {
        $form = $this->createForm(AddPlayerType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $player = $form->getData();
            $this->em->persist($player);
            $this->em->flush();

            $this->addFlash('success', $this->translator->trans('app.flash.success.add_player'));
        }

        return $this->redirectToRoute('app_home');
    }
}
