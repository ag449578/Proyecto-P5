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
    public function index(Request $request, ProfesorRepository $profesorRepository, ContenidoRepository $contenidoRepository): Response
    {
        //Para obtener el usuario logueado
        $id = $this->getUser()->getId();
        $profesor=$profesorRepository->find($id);

        // Para la paginacion
        $offset = max(0, $request->query->getInt('offset', 0));
        $order = $request->query->get('order', 'id');
        $paginator = $contenidoRepository->getContenidoPaginator($offset, $order);

        return $this->render('/profesor/contenido/index.html.twig', [
            'profesor' => $profesor,
            'contenidos' => $paginator,
            'anterior' => $offset - ContenidoRepository::PAGINATOR_PER_PAGE,
            'siguiente' => min(count($paginator), $offset + ContenidoRepository::PAGINATOR_PER_PAGE),
            'numb_pag' => ceil(count($paginator) / ContenidoRepository::PAGINATOR_PER_PAGE),
            'offset' => $offset,
            'per_page' => ContenidoRepository::PAGINATOR_PER_PAGE,
            'order' => $order
        ]);
    }
}
