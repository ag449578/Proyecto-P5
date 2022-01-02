<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    /**
     * @Route("/", name="welcome")
     */
    public function index(): Response
    {
        return $this->render('welcome/index.html.twig');
    }

    /**
     * @Route("/navbar", name="navbar")
     */
    public function navbar(): Response
    {

        $links = [];

        if($this->isGranted("ROLE_ADMIN")){

            $links = [
                'Administración' => 'administrador',
                'Usuarios' => 'usuarios'
            ];

        }elseif($this->isGranted("ROLE_TEACHER")){

            $links = [
                'Principal' => 'profesor',
            ];

        }elseif($this->isGranted("ROLE_USER")){

            $links = [
                'Principal' => 'estudiantes',
            ];
            
        }


        return $this->render('welcome/navbar.html.twig', [
            'links' => $links,
        ]);
    }
}
