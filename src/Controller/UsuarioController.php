<?php

namespace App\Controller;

use App\Entity\Administrador;
use App\Entity\Estudiante;
use App\Entity\Profesor;
use App\Entity\Usuario;
use App\Form\UsuarioType;
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
     * @Route("/list", name="usuario")
     */
    public function index(): Response
    {

        return $this->render('usuario/index.html.twig');
    }

    /**
     * @Route("/new", name="new_user")
     */
    public function new(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $usuario = new Usuario();
        $form = $this->createForm(UsuarioType::class, $usuario);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid()) {

            // Administrador
            if($form->get('rol')->getData() == "ROLE_ADMIN"){
                
                $admin = new Administrador();
                $admin->setCorreo($usuario->getCorreo());
                $admin->setNombUsuario($usuario->getNombUsuario());
                $admin->setPassword($usuario->getPassword());
                $admin->setSolapin($usuario->getSolapin());
                $admin->setRoles(["ROLE_ADMIN"]);
                $admin->setTelefonoEmergencia($form->get('telefono_emergencia')->getData());
                $admin->setCentro($form->get('centro')->getData());

                $hashedPassword = $passwordHasher->hashPassword(
                    $usuario,
                    $usuario->getPassword()
                );
                $admin->setPassword($hashedPassword);

                $this->entityManager->persist($admin);
                $this->entityManager->flush();

                return $this->redirectToRoute('usuario');


            // Profesor
            }elseif($form->get('rol')->getData() == "ROLE_TEACHER") {

                $profesor = new Profesor();
                $profesor->setCorreo($usuario->getCorreo());
                $profesor->setNombUsuario($usuario->getNombUsuario());
                $profesor->setPassword($usuario->getPassword());
                $profesor->setSolapin($usuario->getSolapin());
                $profesor->setRoles(["ROLE_TEACHER"]);
                $profesor->setCategoriaDocente($form->get('categoria_docente')->getData());

                $hashedPassword = $passwordHasher->hashPassword(
                    $usuario,
                    $usuario->getPassword()
                );
                $profesor->setPassword($hashedPassword);

                $this->entityManager->persist($profesor);
                $this->entityManager->flush();

                return $this->redirectToRoute('usuario');

            // Estudiante
            }elseif($form->get('rol')->getData() == "ROLE_USER") {
                
                $estudiate = new Estudiante();
                $estudiate->setCorreo($usuario->getCorreo());
                $estudiate->setNombUsuario($usuario->getNombUsuario());
                $estudiate->setPassword($usuario->getPassword());
                $estudiate->setSolapin($usuario->getSolapin());
                $estudiate->setRoles(["ROLE_TEACHER"]);
                $estudiate->setAnnoCursa($form->get('anno_cursa')->getData());

                $hashedPassword = $passwordHasher->hashPassword(
                    $usuario,
                    $usuario->getPassword()
                );
                $estudiate->setPassword($hashedPassword);

                $this->entityManager->persist($estudiate);
                $this->entityManager->flush();

                return $this->redirectToRoute('usuario');

            }
        }

        return $this->render('usuario/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
