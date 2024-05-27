<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Form\ApprenantType;
use App\Repository\ApprenantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApprenantController extends AbstractController
{
    #[Route('/apprenant', name: 'app_apprenant')]
    // public function index(EntityManagerInterface $entityManager): Response
    public function index(ApprenantRepository $apprenantRepository): Response
    {
        // $apprenants = $entityManager->getRepository(Apprenant::class)->findAll();
        // SELECT * FROM apprenant ORDER BY nom ASC
        $apprenants = $apprenantRepository->findBy([], ["nom" => "ASC"]);
        return $this->render('apprenant/index.html.twig', [
            'apprenants' => $apprenants
        ]);
    }
    
    #[Route('/apprenant/new', name: 'new_apprenant')]
    #[Route('/apprenant/{id}/edit', name: 'edit_apprenant')]
    public function new_edit(Apprenant $apprenant = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        // si l'apprenant n'existe pas
        if(!$apprenant){
            // on crée un nouvel objet Apprenant
            $apprenant = new Apprenant();
        }

        // la méthode createForm permet de créer le formulaire
        // on attribue au formulaire les propriétés de l'objet Apprenant nouvellement créé
        $form = $this->createForm(ApprenantType::class, $apprenant);

        // on traite la soumission du formulaire
        $form->handleRequest($request);

        // si le formulaire a été soumis et qu'il est valide:
        if ($form->isSubmitted() && $form->isValid()) {
            
            // alors on récupère les données du formulaire et on les transmet à l'objet Apprenant
            $apprenant = $form->getData();

            // on dit à Doctrine de persister càd de préparer la requête pour l'ajout en BDD
            $entityManager->persist($apprenant);

            // Doctrine exécute la requête (i.e. the INSERT query)
            $entityManager->flush();

            // on redirige vers la liste des apprenants
            return $this->redirectToRoute('app_apprenant');
        }

        // on renvoie à la vue les données
        return $this->render('apprenant/new.html.twig', [
            'formAddApprenant' => $form,
            'edit' => $apprenant->getId()
        ]);
    }

    // cette route avec l'id est en dernier car il y a un ordre de priorité dans les routes
    #[Route('/apprenant/{id}', name: 'show_apprenant')]
    public function show(Apprenant $apprenant): Response
    {
        return $this->render('apprenant/show.html.twig', [
            'apprenant' => $apprenant
        ]);
    }

}
