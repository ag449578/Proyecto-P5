<?php

namespace App\Form;

use App\Entity\Estudiante;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class EstudianteType extends UsuarioType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        parent::buildForm($builder, $options);
        $builder        
            ->add('anno_cursa')            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Estudiante::class,
        ]);
    }
}
