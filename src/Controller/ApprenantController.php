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
    public function new(Request $request): Response
    {
        // on crée un nouvel objet Apprenant
        $apprenant = new Apprenant();

        // la méthode createForm permet de créer le formulaire
        // on attribue au formulaire les propriétés de l'objet Apprenant nouvellement créé
        $form = $this->createForm(ApprenantType::class, $apprenant);

        // on renvoie à la vue les données
        return $this->render('apprenant/new.html.twig', [
            'formAddApprenant' => $form,
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
