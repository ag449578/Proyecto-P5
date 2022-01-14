<?php

namespace App\Controller;

use App\Repository\ContenidoRepository;
use App\Repository\ProfesorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContenidoController extends AbstractController
{
    /**
     * @Route("/profesor/contenido", name="contenido")
     */
    public function index(ProfesorRepository $profesorRepository, ContenidoRepository $contenidoRepository): Response
    {
        //Para obtener el usuario logueado
        $id = $this->getUser()->getId();
        $profesor=$profesorRepository->find($id);

        return $this->render('/profesor/contenido/index.html.twig', [
            'profesor' => $profesor,
        ]);
    }
}
