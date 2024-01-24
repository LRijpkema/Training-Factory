<?php

namespace App\Form;

use App\Entity\Lesson;
use App\Entity\Registration;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormView;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('payment')
            ->add('lesson', EntityType::class, [
                'class' => Lesson::class,
                'choice_label' => 'id',
            ])
            ->add('member', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'firstname',
            ])
            ->add('submit', SubmitType::class, [
            'label' => 'Registration',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Registration::class,
        ]);
    }
}
