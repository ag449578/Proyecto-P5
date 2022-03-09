<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Asignatura;
use App\Repository\AsignaturaRepository;
use App\Repository\EstudianteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


use App\Entity\Asignatura;
use App\Form\AsignaturaType;
use App\Repository\AsignaturaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\Math;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;



class EstudianteController extends AbstractController
{
    /**
     * @Route("/estudiante", name="estudiante", methods={"GET"})
     */
    public function index(Request $request, AsignaturaRepository $asignaturaRepository): Response
    {
        // getAsignaturasEstudiantePaginator(int $offset, string $order, int $estId);
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $asignaturaRepository->getAsignaturasEstudiantePaginator($offset, 'id', $this->getUser()->getId());
        
        return $this->render('estudiante/index.html.twig', [
            'asignaturas' => $paginator,
            'anterior' => $offset - AsignaturaRepository::PAGINATOR_PER_PAGE,
            'siguiente' => min(count($paginator), $offset + AsignaturaRepository::PAGINATOR_PER_PAGE),
            'numb_pag' => ceil(count($paginator) / AsignaturaRepository::PAGINATOR_PER_PAGE),
            'offset' => $offset,
            'per_page' => AsignaturaRepository::PAGINATOR_PER_PAGE
        ]);
    }

    /**
     * @Route("/estudiante/matricularme/{id}", name="matricularme")
     */
    public function matricularme(Request $request, Asignatura $asignatura,EstudianteRepository $estudianteRepository, EntityManagerInterface $entityManager): Response
    {   
        $route = $request->query->get('route');
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
        if($route == 'asignatura_show') return $this->redirectToRoute('asignatura_show', [ "id" => $asignatura->getId() ]);
        return $this->redirectToRoute($route);
    }

    /**
     * @Route("/estudiante/desmatricularme/{id}", name="desmatricularme")
     */
    public function desmatricularme(Request $request, Asignatura $asignatura, EstudianteRepository $estudianteRepository, EntityManagerInterface $entityManager): Response
    {
        $route = $request->query->get('route');
        $id = $this->getUser()->getId();
        $estudiante = $estudianteRepository->findOneBy([
            'id' => $id
        ]);
        if($estudiante){
            $estudiante->removeAsignatura($asignatura);
        }
        $entityManager->persist($estudiante);
        $entityManager->flush();
        if($route == 'asignatura_show') return $this->redirectToRoute('asignatura_show', [ "id" => $asignatura->getId() ]);
        return $this->redirectToRoute($route);

    }
}
