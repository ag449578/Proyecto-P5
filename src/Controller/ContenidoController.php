<?php

namespace App\Controller;


use App\Entity\Contenido;
use App\Form\ContenidoType;
use App\Repository\ContenidoRepository;
use App\Repository\ProfesorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Mime\FileinfoMimeTypeGuesser;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profesor")
 */
class ContenidoController extends AbstractController
{
    /**
     * @Route("/contenido", name="contenido_index", methods={"GET"})
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
    public function new(Request $request, EntityManagerInterface $entityManager, string $contenidoDir): Response
    {
        $contenido = new Contenido();
        $form = $this->createForm(ContenidoType::class, $contenido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //para guardar nombre y url del archivo
            $archivo = $form->get('archivo')->getData();
            if ($archivo) {
                
                $filename = pathinfo($archivo->getClientOriginalName(), PATHINFO_FILENAME).'.'.$archivo->guessExtension();
                
                try {
                    $archivo->move($contenidoDir, $filename);
                } catch (FileException $e) {

                }
                $contenido->setUrlArchivo($filename);
            }

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
     * @Route("/{id}/edit", name="contenido_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Contenido $contenido, EntityManagerInterface $entityManager, string $contenidoDir): Response
    {
        $form = $this->createForm(ContenidoType::class, $contenido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //para guardar nombre y url del archivo
            $archivo = $form->get('archivo')->getData();
            if ($archivo) {

                $filename = pathinfo($archivo->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $archivo->guessExtension();

                try {
                    $archivo->move($contenidoDir, $filename);
                } catch (FileException $e) {

                }
                $contenido->setUrlArchivo($filename);
            }

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
     * @Route("/descarga/{nombre}", name="descarga", methods={"GET"})
     */
    public function descarga(string $nombre, string $contenidoDir):Response
    {
        $ruta=$contenidoDir.$nombre;
        $response=new BinaryFileResponse($ruta);
        $mime=new FileinfoMimeTypeGuesser();
        $name=$nombre;

        if ($mime->isGuesserSupported()) {
            $response->headers->set('Content-Type',$mime->guessMimeType($contenidoDir.$nombre));
        }else{
            $response->headers->set('Content-Type', 'text/plain');
        }

        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $name
        );

        return $response;
    }
}




