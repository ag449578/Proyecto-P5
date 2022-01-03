<?php

namespace App\Controller;

use App\Entity\Asignatura;
use App\Form\AsignaturaType;
use App\Repository\AsignaturaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/administrador/asignaturas")
 */
class AsignaturaController extends AbstractController
{
    /**
     * @Route("/", name="asignatura_index", methods={"GET"})
     */
    public function index(AsignaturaRepository $asignaturaRepository): Response
    {
        return $this->render('administrador/asignatura/index.html.twig', [
            'asignaturas' => $asignaturaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="asignatura_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $asignatura = new Asignatura();
        $form = $this->createForm(AsignaturaType::class, $asignatura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($asignatura);
            $entityManager->flush();

            return $this->redirectToRoute('asignatura_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('administrador/asignatura/new.html.twig', [
            'asignatura' => $asignatura,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="asignatura_show", methods={"GET"})
     */
    public function show(Asignatura $asignatura): Response
    {
        return $this->render('administrador/asignatura/show.html.twig', [
            'asignatura' => $asignatura,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="asignatura_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Asignatura $asignatura, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AsignaturaType::class, $asignatura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('asignatura_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('administrador/asignatura/edit.html.twig', [
            'asignatura' => $asignatura,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="asignatura_delete", methods={"POST"})
     */
    public function delete(Request $request, Asignatura $asignatura, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$asignatura->getId(), $request->request->get('_token'))) {
            foreach( $asignatura->getProfesores() as $profesor ){
                $profesor->setAsignatura(null);
            }
            $entityManager->remove($asignatura);
            $entityManager->flush();
        }

        return $this->redirectToRoute('asignatura_index', [], Response::HTTP_SEE_OTHER);
    }
}
