<?php

namespace App\Form;

use App\Entity\Training;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrainingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name')
            ->add('description')
            ->add('duration')
            ->add('extra_cost')
            ->add('image', ChoiceType::class, [
                'choices' => [
                    'Hiit' => 'imgs/hiit.jpg',
                    'Kickboxing' => 'imgs/kickboxing.jpg',
                    'Boxing' => 'imgs/boxing.jpg',

                ],

            ])        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Training::class,
        ]);
    }
}
