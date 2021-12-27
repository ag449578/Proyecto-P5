<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdministradorController extends AbstractController
{
    /**
     * @Route("/administrador", name="administrador")
     */
    public function index(): Response
    {
        return $this->render('administrador/index.html.twig', [
            'controller_name' => 'AdministradorController',
        ]);
    }
}
