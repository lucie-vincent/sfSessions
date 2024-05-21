<?php

namespace App\Controller;

use App\Repository\UniteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UniteController extends AbstractController
{
    #[Route('/unite', name: 'app_unite')]
    public function index(UniteRepository $uniteRepository): Response
    {
        $unites = $uniteRepository->findBy([], ["intitule" => "ASC"]);
        return $this->render('unite/index.html.twig', [
            'unites' => $unites
        ]);
    }
}
