<?php

namespace App\Controller;

use App\Entity\Programme;
use App\Repository\ProgrammeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProgrammeController extends AbstractController
{
    // #[Route('/programme', name: 'app_programme')]
    // public function index(ProgrammeRepository $programmeRepository): Response
    // {
    //     $programmes = $programmeRepository->findBy([], ["session" =>"ASC"]);
    //     return $this->render('programme/index.html.twig', [
    //         'programmes' => $programmes
    //     ]);
    // }

    // #[Route('/programme/{id}', name: 'show_programme')]
    // public function show(Programme $programme): Response
    // {
    //     return $this->render('programme/show.html.twig', [
    //         'programme' => $programme
    //     ]);
    // }
}
