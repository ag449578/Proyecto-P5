<?php

namespace App\Command;

use App\Entity\Administrador;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class CreateAdminCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:create-admin';
    protected static $defaultDescription = 'Crea un usuario por un nombre, correo y contraseña dado, si el usuario con esas caracteristicas ya existe actualiza la contraseña.';

    public function __construct(bool $requirePassword = false, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher)
    {
        // best practices recommend to call the parent constructor first and
        // then set your own properties. That wouldn't work in this case
        // because configure() needs the properties set in this constructor
        $this->requirePassword = $requirePassword;
        $this->passwordHasher = $passwordHasher;
        $this->doctrine = $doctrine;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('nomb_usuario', InputArgument::REQUIRED, 'El nombre del usuario admin.')
            ->addArgument('correo', InputArgument::REQUIRED, 'El correo del usuario.')
            ->addArgument('password', $this->requirePassword ? InputArgument::REQUIRED : InputArgument::OPTIONAL, 'Contraseña, opcional(default: 123456)')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // ... put here the code to create the user

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        // return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID

        $entityManager = $this->doctrine->getManager();
        try{

            $nomb_usuario = $input->getArgument('nomb_usuario');
            $correo = $input->getArgument('correo');
            $password = $input->getArgument('password') ? $input->getArgument('password') : "123456";

            $admin = $entityManager->getRepository(Administrador::class)->findOneBy([
                'nomb_usuario' => $nomb_usuario,
                'correo' => $correo,
            ]);

            if(!$admin){
                $admin = new Administrador();
                $admin->setCorreo($correo);
                $admin->setNombUsuario($nomb_usuario);
                $admin->setSolapin("T111111");
                $admin->setRoles(["ROLE_ADMIN"]);
                $admin->setTelefonoEmergencia("55555555");
                $admin->setCentro("SGCD");
            }

            $hashedPassword = $this->passwordHasher->hashPassword(
                $admin,
                $password
            );

            $admin->setPassword($hashedPassword);

            $entityManager->persist($admin);
            $entityManager->flush();

            $output->writeln(['', 'Admin creado correctamente:', 
                'Nombre: '.$nomb_usuario, 
                'Correo: '.$correo, 
                'Contraseña: '. $password,
                'Contraseña cifrada: '.$hashedPassword
            ]);


            return Command::SUCCESS;
        }catch(Exception $e){
            return Command::FAILURE;
        }

    }
}