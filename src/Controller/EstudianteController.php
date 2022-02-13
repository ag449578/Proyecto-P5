<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Asignatura;
use App\Repository\EstudianteRepository;
use Doctrine\ORM\EntityManagerInterface;

class EstudianteController extends AbstractController
{
    /**
     * @Route("/estudiante", name="estudiante")
     */
    public function index(): Response
    {
        return $this->render('estudiante/index.html.twig', [
            'controller_name' => 'EstudianteController',
        ]);
    }

    /**
     * @Route("/estudiante/matricularme/{id}", name="matricularme")
     */
    public function matricularme(Asignatura $asignatura, EstudianteRepository $estudianteRepository, EntityManagerInterface $entityManager): Response
    {
        $id = $this->getUser()->getId();
        $estudiante = $estudianteRepository->findOneBy([
            'id' => $id
        ]);
        if($estudiante){
            $estudiante->addAsignatura($asignatura);
        }
        // $estudiante->removeAsignatura($asignatura);
        $entityManager->persist($estudiante);
        $entityManager->flush();
        return $this->redirectToRoute('asignatura_show', [ "id" => $asignatura->getId() ]);
    }

    /**
     * @Route("/estudiante/desmatricularme/{id}", name="desmatricularme")
     */
    public function desmatricularme(Asignatura $asignatura, EstudianteRepository $estudianteRepository, EntityManagerInterface $entityManager): Response
    {
        
        $id = $this->getUser()->getId();
        $estudiante = $estudianteRepository->findOneBy([
            'id' => $id
        ]);
        if($estudiante){
            $estudiante->removeAsignatura($asignatura);
        }
        // $estudiante->removeAsignatura($asignatura);
        $entityManager->persist($estudiante);
        $entityManager->flush();
        return $this->redirectToRoute('asignatura_show', [ "id" => $asignatura->getId() ]);
    }
}
