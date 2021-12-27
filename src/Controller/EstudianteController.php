<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EstudianteController extends AbstractController
{
    /**
     * @Route("/estudiante", name="estudiante")
     */
    public function index(): Response
    {
        return $this->render('estudiante/index.html.twig', [
            'controller_name' => 'EstudianteController',
        ]);
    }
}
