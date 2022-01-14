<?php

namespace App\Controller;

use App\Entity\Solicitud;
use App\Repository\SolicitudRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SolicitudController extends AbstractController
{
    /**
     * @Route("/profesor/solicitud", name="solicitud")
     */
    public function index(Request $request, SolicitudRepository $solicitudRepository): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $order = $request->query->get('order', 'id');
        $paginator = $solicitudRepository->getSolicitudPaginator($offset, $order);

        return $this->render('/profesor/solicitud/index.html.twig', [
            'solicitudes' => $paginator,
            'anterior' => $offset - SolicitudRepository::PAGINATOR_PER_PAGE,
            'siguiente' => min(count($paginator), $offset + SolicitudRepository::PAGINATOR_PER_PAGE),
            'numb_pag' => ceil(count($paginator) / SolicitudRepository::PAGINATOR_PER_PAGE),
            'offset' => $offset,
            'per_page' => SolicitudRepository::PAGINATOR_PER_PAGE,
            'order' => $order
        ]);
    }

    /**
     * @Route("/solicitud/{id}", name="solicitud_show", methods={"GET"})
     */
    public function show(Solicitud $solicitud): Response
    {
        return $this->render('profesor/solicitud/show.html.twig', [
            'solicitud' => $solicitud,
        ]);
    }
}
