<?php

namespace App\Controller;

use App\Entity\Contenido;
use App\Form\ContenidoType;
use App\Repository\ContenidoRepository;
use App\Repository\ProfesorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contenido")
 */
class ContenidoController extends AbstractController
{
    /**
     * @Route("/", name="contenido_index", methods={"GET"})
     */
    public function index(ContenidoRepository $contenidoRepository, ProfesorRepository $profesorRepository): Response
    {
        // Para obtener el usuario logueado
        $id = $this->getUser()->getId();
        $profesor=$profesorRepository->find($id);

        return $this->render('/profesor/contenido/index.html.twig', [
            'profesor' => $profesor,
        ]);
    }

    /**
     * @Route("/new", name="contenido_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contenido = new Contenido();
        $form = $this->createForm(ContenidoType::class, $contenido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contenido);
            $entityManager->flush();

            return $this->redirectToRoute('contenido_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profesor/contenido/new.html.twig', [
            'contenido' => $contenido,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="contenido_show", methods={"GET"})
     */
    public function show(Contenido $contenido): Response
    {
        return $this->render('/profesor/contenido/show.html.twig', [
            'contenido' => $contenido,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="contenido_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Contenido $contenido, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContenidoType::class, $contenido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('contenido_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profesor/contenido/edit.html.twig', [
            'contenido' => $contenido,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="contenido_delete", methods={"POST"})
     */
    public function delete(Request $request, Contenido $contenido, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contenido->getId(), $request->request->get('_token'))) {
            $entityManager->remove($contenido);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contenido_index', [], Response::HTTP_SEE_OTHER);
    }
}




