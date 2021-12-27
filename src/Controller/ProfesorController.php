<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfesorController extends AbstractController
{
    /**
     * @Route("/profesor", name="profesor")
     */
    public function index(): Response
    {
        return $this->render('profesor/index.html.twig', [
            'controller_name' => 'ProfesorController',
        ]);
    }
}
