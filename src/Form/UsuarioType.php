<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('correo')
            ->add('rol', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices' => [
                    "Seleccione..." => '',
                    "Estudiante" => 'ROLE_USER',
                    "Profesor" => 'ROLE_TEACHER',
                    "Administrador" => 'ROLE_ADMIN'
                ],
                'mapped' => false
            ])
            ->add('password', PasswordType::class)
            ->add('rep_password', PasswordType::class, [
                "mapped" => false
            ])

            ->add('nomb_usuario')
            ->add('solapin')
            
            // Administrador
            ->add('telefono_emergencia', null, [
                'required' => false,
                "mapped" => false
            ])
            ->add('centro', null, [
                'required' => false,
                "mapped" => false
            ])

            // Profesor
            ->add('categoria_docente', null, [
                'required' => false,
                "mapped" => false
            ])

            // Estudiante
            ->add('anno_cursa', ChoiceType::class, [
                'choices' => [
                    "--Seleccione--" => null,
                    "1ro" => '1',
                    "2do" => '2',
                    "3ro" => '3',
                    "4to" => '4',
                    "5to" => '5',
                ],
                'required' => false,
                "mapped" => false
            ])
            
            // SUBMIT
            ->add('enviar', SubmitType::class)
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
