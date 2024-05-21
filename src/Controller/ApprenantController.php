<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Repository\ApprenantRepository;
use Doctrine\ORM\EntityManagerInterface;
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
        $apprenants = $apprenantRepository->findAll();
        return $this->render('apprenant/index.html.twig', [
            'apprenants' => $apprenants
        ]);
    }
}
