<?php

namespace App\Controller;

use App\Entity\Session;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    #[Route('/session/{id}/edit', name: 'edit_session')]
    public function new_edit(Session $session = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        // si la session n'existe pas :
        if(!$session){
            // on crée un nouvel objet session
            $session = new Session();
        }

        // la méthode createForm permet de créer le formulaire
        // on attribue au formulaire les propriétés de l'objet session nouvellement créé
        $form = $this->createForm(SessionType::class, $session);

        // on traite la soumission du formulaire
        $form->handleRequest($request);

        // si le formulaire a été soumis et qu'il est valide:
        if ($form->isSubmitted() && $form->isValid()) {
            
            // alors on récupère les données du formulaire et on les transmet à l'objet Apprenant
            $session = $form->getData();

            // on dit à Doctrine de persister càd de préparer la requête pour l'ajout en BDD
            $entityManager->persist($session);

            // Doctrine exécute la requête (i.e. the INSERT query)
            $entityManager->flush();

            // on redirige vers la liste des sessions
            return $this->redirectToRoute('app_session');
        }

        // on renvoie à la vue les données
        return $this->render('session/new.html.twig', [
            'formAddSession' => $form,
            'edit' => $session->getId()
        ]);
    }

    #[Route('/session/{id}/delete', name: 'delete_session')]
    public function delete(Session $session, EntityManagerInterface $entityManager)
    {
        // Doctrine prépare (persiste) la requête
        $entityManager->remove($session);
        // Doctrine exécute la requête : "DELETE FROM session WHERE session..."
        $entityManager->flush();
        
        // on redirige vers la liste des sessions
        return $this->redirectToRoute('app_session');
    }

    #[Route('/session/{id}', name: 'show_session')]
    public function show(Session $session): Response
    {
        return $this->render('session/show.html.twig', [
            'session' => $session
        ]);
    }
}
