<?php

namespace App\Controller;

use App\Entity\Administrador;
use App\Entity\Estudiante;
use App\Entity\Profesor;
use App\Entity\Usuario;
use App\Form\AdministradorType;
use App\Form\EstudianteType;
use App\Form\ProfesorType;
use App\Repository\UsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @Route("/administrador/usuarios")
 */
class UsuarioController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="usuarios")
     */
    public function index(Request $request,UsuarioRepository $usuarioRepository): Response
    {

        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $usuarioRepository->getUsuariosPaginator($offset);
        

        return $this->render('administrador/usuarios/index.html.twig', [
            'usuarios' => $paginator,
            'anterior' => $offset - UsuarioRepository::PAGINATOR_PER_PAGE,
            'siguiente' => min(count($paginator), $offset + UsuarioRepository::PAGINATOR_PER_PAGE),
            'numb_pag' => ceil(count($paginator) / UsuarioRepository::PAGINATOR_PER_PAGE),
            'offset' => $offset,
            'per_page' => UsuarioRepository::PAGINATOR_PER_PAGE
        ]);
    }

    /**
     * @Route("/nuevo_estudiante", name="nuevo_estudiante")
     */
    public function nuevo_estudiante(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $estudiate = new Estudiante();
        $form = $this->createForm(EstudianteType::class, $estudiate);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid()) {
            $estudiate->setRoles(["ROLE_USER"]);

            $hashedPassword = $passwordHasher->hashPassword(
                $estudiate,
                $estudiate->getPassword()
            );
            $estudiate->setPassword($hashedPassword);
            
            $this->entityManager->persist($estudiate);
            $this->entityManager->flush();

            return $this->redirectToRoute('usuarios');
        }

        return $this->render('administrador/usuarios/edit_estudiante.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/nuevo_profesor", name="nuevo_profesor")
     */
    public function nuevo_profesor(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $profesor = new Profesor();
        $form = $this->createForm(ProfesorType::class, $profesor);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid()) {
            $profesor->setRoles(["ROLE_TEACHER"]);

            $hashedPassword = $passwordHasher->hashPassword(
                $profesor,
                $profesor->getPassword()
            );
            $profesor->setPassword($hashedPassword);

            $this->entityManager->persist($profesor);
            $this->entityManager->flush();

            return $this->redirectToRoute('usuarios');
        }

        return $this->render('administrador/usuarios/edit_profesor.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/nuevo_administrador", name="nuevo_administrador")
     */
    public function nuevo_administrador(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $admin = new Administrador();
        $form = $this->createForm(AdministradorType::class, $admin);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid()) {
            $admin->setRoles(["ROLE_ADMIN"]);

            $hashedPassword = $passwordHasher->hashPassword(
                $admin,
                $admin->getPassword()
            );
            $admin->setPassword($hashedPassword);

            $this->entityManager->persist($admin);
            $this->entityManager->flush();

            return $this->redirectToRoute('usuarios');
        }

        return $this->render('administrador/usuarios/edit_administrador.html.twig', [
            'form' => $form->createView()
        ]);

    }


    /**
     * @Route("/{id}/edit", name="usuario_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Usuario $usuario, EntityManagerInterface $entityManager): Response
    {
        $types = [
            'ROLE_USER' => [EstudianteType::class, 'administrador/usuarios/edit_estudiante.html.twig'],
            'ROLE_TEACHER' => [ProfesorType::class, 'administrador/usuarios/edit_profesor.html.twig'],
            'ROLE_ADMIN' => [AdministradorType::class, 'administrador/usuarios/edit_administrador.html.twig']
        ];        

        $form = $this->createForm($types[$usuario->getRoles()[0]][0], $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('usuario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm($types[$usuario->getRoles()[0]][1], [
            'usuario' => $usuario,
            'form' => $form,
        ]);
    }
    /**
     * @Route("/usuarios/{id}", name="usuario_delete", methods={"POST"})
     */

    public function delete(Request $request, Usuario $usuario, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$usuario->getId(), $request->request->get('_token'))) {
            $entityManager->remove($usuario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('usuarios', [], Response::HTTP_SEE_OTHER);
    }
}
