<?php

namespace App\Controller;

use App\Entity\Solicitud;
use App\Form\SolicitudType;
use App\Repository\SolicitudRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/solicitud")
 */
class SolicitudController extends AbstractController
{
    /**
     * @Route("/profesor", name="solicitud")
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
     * @Route("/{id}", name="solicitud_show", methods={"GET"})
     */
    public function show(Solicitud $solicitud): Response
    {
        return $this->render('estudiante/profesor/solicitud/show.html.twig', [
            'solicitud' => $solicitud,
        ]);
    }

    // Will
    #[Route('/estudiante/solicitud', name: 'solicitud_index', methods: ['GET'])]
    public function index_estudiante(SolicitudRepository $solicitudRepository, Request $request): Response
    {
        /*return $this->render('estudiante/solicitud/index.html.twig', [
            'solicitudes' => $solicitudRepository->findBy([
                'estudiante' => $this->getUser()
            ]),
        ]);*/

        $offset = max(0, $request->query->getInt('offset', 0));
        $order = $request->query->get('order', 'id');
        $paginator = $solicitudRepository->getSolicitudPaginator($offset, $order);
        $state = $request->query->get('estado');

        return $this->render('estudiante/solicitud/index.html.twig', [
            'solicitudes' => $paginator,
            'anterior' => $offset - SolicitudRepository::PAGINATOR_PER_PAGE,
            'siguiente' => min(count($paginator), $offset + SolicitudRepository::PAGINATOR_PER_PAGE),
            'numb_pag' => ceil(count($paginator) / SolicitudRepository::PAGINATOR_PER_PAGE),
            'offset' => $offset,
            'per_page' => SolicitudRepository::PAGINATOR_PER_PAGE,
            'order' => $order,
            'state' => $state
        ]);
    }

    #[Route('/estudiante/solicitud/new', name: 'solicitud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $solicitud = new Solicitud();
        $form = $this->createForm(SolicitudType::class, $solicitud);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $solicitud->setEstado('0');
            $solicitud->setEstudiante($this->getUser());
            $entityManager->persist($solicitud);
            $entityManager->flush();

            return $this->redirectToRoute('solicitud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('estudiante/solicitud/new.html.twig', [
            'solicitud' => $solicitud,
            'form' => $form,
        ]);
    }

    #[Route('/estudiante/solicitud/{id}', name: 'solicitud_show', methods: ['GET'])]
    public function show_estudiante(Solicitud $solicitud): Response
    {
        return $this->render('estudiante/solicitud/show.html.twig', [
            'solicitud' => $solicitud,
        ]);
    }

    #[Route('/estudiante/solicitud/{id}/edit', name: 'solicitud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Solicitud $solicitud, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SolicitudType::class, $solicitud);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('solicitud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('estudiante/solicitud/edit.html.twig', [
            'solicitud' => $solicitud,
            'form' => $form,
        ]);
    }

    #[Route('/estudiante/solicitud/{id}', name: 'solicitud_delete', methods: ['POST'])]
    public function delete(Request $request, Solicitud $solicitud, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$solicitud->getId(), $request->request->get('_token'))) {
            $entityManager->remove($solicitud);
            $entityManager->flush();
        }

        return $this->redirectToRoute('solicitud_index', [], Response::HTTP_SEE_OTHER);
    }
}
