<?php

namespace App\Controller;

use App\Entity\SeccionContenidos;
use App\Form\SeccionContenidosType;
use App\Repository\SeccionContenidosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/seccion/contenidos")
 */
class SeccionContenidosController extends AbstractController
{
    /**
     * @Route("/", name="seccion_contenidos_index", methods={"GET"})
     */
    public function index(SeccionContenidosRepository $seccionContenidosRepository): Response
    {
        return $this->render('profesor/seccion_contenidos/index.html.twig', [
            'seccion_contenidos' => $seccionContenidosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="seccion_contenidos_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $seccionContenido = new SeccionContenidos();
        $form = $this->createForm(SeccionContenidosType::class, $seccionContenido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($seccionContenido);
            $entityManager->flush();

            return $this->redirectToRoute('seccion_contenidos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profesor/seccion_contenidos/new.html.twig', [
            'seccion_contenido' => $seccionContenido,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="seccion_contenidos_show", methods={"GET"})
     */
    public function show(SeccionContenidos $seccionContenido): Response
    {
        return $this->render('profesor/seccion_contenidos/show.html.twig', [
            'seccion_contenido' => $seccionContenido,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="seccion_contenidos_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, SeccionContenidos $seccionContenido, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SeccionContenidosType::class, $seccionContenido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('seccion_contenidos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profesor/seccion_contenidos/edit.html.twig', [
            'seccion_contenido' => $seccionContenido,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="seccion_contenidos_delete", methods={"POST"})
     */
    public function delete(Request $request, SeccionContenidos $seccionContenido, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seccionContenido->getId(), $request->request->get('_token'))) {
            $entityManager->remove($seccionContenido);
            $entityManager->flush();
        }

        return $this->redirectToRoute('seccion_contenidos_index', [], Response::HTTP_SEE_OTHER);
    }
}
