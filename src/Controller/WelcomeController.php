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
                'Asignaturas' => 'asignatura_index',
                'Usuarios' => 'usuarios'
            ];

        }elseif($this->isGranted("ROLE_TEACHER")){

            $links = [
                'Profesor' => 'profesor',
                'Contenidos' => 'contenido',
                'Solicitudes' => 'solicitud',
            ];

        }elseif($this->isGranted("ROLE_USER")){

            $links = [
                'Principal' => 'estudiante',
            ];
            
        }


        return $this->render('welcome/navbar.html.twig', [
            'links' => $links,
        ]);
    }
}
