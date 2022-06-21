<?php

namespace App\Form;

use App\Entity\CarPool;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CarPoolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('start_location')
            ->add('stop_location')
            ->add('start_time')
            ->add('stop_time')
            ->add('price')
            ->add('user_id')
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary float-end mb-2'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CarPool::class,
        ]);
    }
}