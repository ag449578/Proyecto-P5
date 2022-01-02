<?php

namespace App\Controller;

use App\Entity\Administrador;
use App\Entity\Estudiante;
use App\Entity\Profesor;
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
    public function index(UsuarioRepository $usuarioRepository): Response
    {

        $usuarios = $usuarioRepository->findAll();

        return $this->render('administrador/usuarios/index.html.twig', [
            'usuarios' => $usuarios
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

        return $this->render('administrador/usuarios/nuevo_estudiante.html.twig', [
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

        return $this->render('administrador/usuarios/nuevo_profesor.html.twig', [
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

        return $this->render('administrador/usuarios/nuevo_administrador.html.twig', [
            'form' => $form->createView()
        ]);

    }

}
