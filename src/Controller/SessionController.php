<?php

namespace App\Controller;

use App\Entity\Session;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(SessionRepository $sessionRepository): Response
    {
        // SELECT * FROM session ORDER BY intitule ASC
        $sessions = $sessionRepository->findBy([], ["intitule" => "ASC"]);
        return $this->render('session/index.html.twig', [
            'sessions' => $sessions
        ]);
    }

    #[Route('/session/new', name: 'new_session')]
    public function new(Request $request): Response
    {
        // on crée un nouvel objet session
        $session = new Session();

        // la méthode createForm permet de créer le formulaire
        // on attribue au formulaire les propriétés de l'objet session nouvellement créé
        $form = $this->createForm(SessionType::class, $session);

        // on renvoie à la vue les données
        return $this->render('session/new.html.twig', [
            'formAddSession' => $form,
        ]);
    }

    #[Route('/session/{id}', name: 'show_session')]
    public function show(Session $session): Response
    {
        return $this->render('session/show.html.twig', [
            'session' => $session
        ]);
    }
}
