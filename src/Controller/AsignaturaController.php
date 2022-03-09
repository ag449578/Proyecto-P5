<?php

namespace App\Controller;

use App\Entity\Asignatura;
use App\Form\AsignaturaType;
use App\Repository\AsignaturaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\Math;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AsignaturaController extends AbstractController
{
    /**
     * @Route("/administrador/asignaturas", name="asignatura_index", methods={"GET"})
     */
    public function index(Request $request ,AsignaturaRepository $asignaturaRepository): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $order = $request->query->get('order', 'id');
        $paginator = $asignaturaRepository->getAsignaturaPaginator($offset, $order);
        

        return $this->render('administrador/asignatura/index.html.twig', [
            'asignaturas' => $paginator,
            'anterior' => $offset - AsignaturaRepository::PAGINATOR_PER_PAGE,
            'siguiente' => min(count($paginator), $offset + AsignaturaRepository::PAGINATOR_PER_PAGE),
            'numb_pag' => ceil(count($paginator) / AsignaturaRepository::PAGINATOR_PER_PAGE),
            'offset' => $offset,
            'per_page' => AsignaturaRepository::PAGINATOR_PER_PAGE,
            'order' => $order
        ]);

        

    }

    /**
     * @Route("/administrador/asignaturas/new", name="asignatura_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, string $photoDir): Response
    {
        $asignatura = new Asignatura();
        $form = $this->createForm(AsignaturaType::class, $asignatura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $asig = $entityManager->getRepository(Asignatura::class)->findOneBy([
                'nombre' => $form->get('nombre')->getData()
            ]);

            if(!$asig){
                if($imagen = $form->get('imagen')->getData()){
    
                    $filename = bin2hex(random_bytes(6).'.'.$imagen->guessExtension());
    
                    try{
                        $imagen->move($photoDir, $filename);
                    }catch(FileException $e){
    
                    }
    
                    $asignatura->setUrlImagen($filename);
                }
                // $form->get('old_password')->addError(new FormError('Contraseña incorrecta.'));
    
    
                $entityManager->persist($asignatura);
                $entityManager->flush();
    
                return $this->redirectToRoute('asignatura_index', [], Response::HTTP_SEE_OTHER);
            }else{
                $form->get('nombre')->addError(new FormError('La asigatura ya existe.'));
            }
        }

        return $this->renderForm('administrador/asignatura/new.html.twig', [
            'asignatura' => $asignatura,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/asignaturas/{id}", name="asignatura_show", methods={"GET"})
     */
    public function show(Asignatura $asignatura): Response
    {
        return $this->render('administrador/asignatura/show.html.twig', [
            'asignatura' => $asignatura,
        ]);
    }

    /**
     * @Route("/asignaturas/", name="asignaturas_public", methods={"GET"})
     */
    public function publicList(Request $request ,AsignaturaRepository $asignaturaRepository): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $asignaturaRepository->getAsignaturaPaginator($offset, 'id');
        

        return $this->render('administrador/asignatura/public_list.html.twig', [
            'asignaturas' => $paginator,
            'anterior' => $offset - AsignaturaRepository::PAGINATOR_PER_PAGE,
            'siguiente' => min(count($paginator), $offset + AsignaturaRepository::PAGINATOR_PER_PAGE),
            'numb_pag' => ceil(count($paginator) / AsignaturaRepository::PAGINATOR_PER_PAGE),
            'offset' => $offset,
            'per_page' => AsignaturaRepository::PAGINATOR_PER_PAGE
        ]);

    }

    /**
     * @Route("/administrador/asignaturas/{id}/edit", name="asignatura_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Asignatura $asignatura, EntityManagerInterface $entityManager, string $photoDir): Response
    {
        $form = $this->createForm(AsignaturaType::class, $asignatura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            if($imagen = $form->get('imagen')->getData()){

                $filename = bin2hex(random_bytes(6).'.'.$imagen->guessExtension());

                try{
                    $imagen->move($photoDir, $filename);
                }catch(FileException $e){

                }

                $asignatura->setUrlImagen($filename);
            }
            $entityManager->flush();

            return $this->redirectToRoute('asignatura_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('administrador/asignatura/edit.html.twig', [
            'asignatura' => $asignatura,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/administrador/asignaturas/{id}", name="asignatura_delete", methods={"POST"})
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
