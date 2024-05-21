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
        // SELECT * FROM apprenant ORDER BY nom ASC
        $apprenants = $apprenantRepository->findBy([], ["nom" => "ASC"]);
        return $this->render('apprenant/index.html.twig', [
            'apprenants' => $apprenants
        ]);
    }
}
