<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Repository\ApprenantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

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

    #[Route('/apprenant/{id}', name: 'show_apprenant')]
    public function show(Apprenant $apprenant): Response
    {
        return $this->render('apprenant/show.html.twig', [
            'apprenant' => $apprenant
        ]);
    }

    #[Route('/apprenant/new', name: 'new_apprenant')]
    public function new(Apprenant $apprenant = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        
    }
}
