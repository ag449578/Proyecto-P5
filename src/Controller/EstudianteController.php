<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function index(Request $request ,AsignaturaRepository $asignaturaRepository): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $asignaturaRepository->getAsignaturaPaginator($offset, 'id');
        

        return $this->render('estudiante/index.html.twig', [
            'asignaturas' => $paginator,
            'anterior' => $offset - AsignaturaRepository::PAGINATOR_PER_PAGE,
            'siguiente' => min(count($paginator), $offset + AsignaturaRepository::PAGINATOR_PER_PAGE),
            'numb_pag' => ceil(count($paginator) / AsignaturaRepository::PAGINATOR_PER_PAGE),
            'offset' => $offset,
            'per_page' => AsignaturaRepository::PAGINATOR_PER_PAGE
        ]);
    }
}
