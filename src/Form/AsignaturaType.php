<?php

namespace App\Form;

use App\Entity\Asignatura;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AsignaturaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('descripcion')
            ->add('imagen', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image(['maxSize' => '2048k'])
                ]
            ])
            ->add('semestre', ChoiceType::class, [
                'choices'  => [
                    'Seleccione...' => "",
                    '1ro' => 1,
                    '2do' => 2,
            ]])
            ->add('horas_clase')
            ->add('cantidad_temas')
            ->add('es_curricular', CheckboxType::class, [
                'required' => false
            ])
            ->add('departamento')
            ->add('anno_imparte')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Asignatura::class,
        ]);
    }
}
