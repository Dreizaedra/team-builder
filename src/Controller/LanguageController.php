<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LanguageSelectorType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Translation\LocaleSwitcher;

class LanguageController extends AbstractController
{
    public function getLanguageSelector(LocaleSwitcher $localeSwitcher): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $form = $this->createForm(LanguageSelectorType::class, $user, [
            'action' => $this->generateUrl('app_set_language'),
        ]);

        return $this->render('partials/_language_selector.html.twig', [
            'languageForm' => $form,
            'currentLocale' => $localeSwitcher->getLocale(),
        ]);
    }

    #[Route('/language', name: 'app_set_language', methods: ['POST'])]
    public function setLanguage(Request $request, EntityManagerInterface $em): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $form = $this->createForm(LanguageSelectorType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $em->persist($user);
            $em->flush();
        }

        return $this->redirect($request->headers->get('referer'));
    }
}
