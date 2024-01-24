<?php

namespace App\Form;


use App\Entity\Lesson;
use App\Entity\Training;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;



class LessonType extends AbstractType
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('training',EntityType::class,[
                'class' => Training::class, 'choice_label' => 'name',
            ])
            ->add('trainer', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'firstname',
                'choices' => $this->getTrainers(),
            ])
            ->add('date', DateType::class, [
                'input'  => 'datetime',
                'widget' => 'choice',
            ])
            ->add('Time', TimeType::class, [
                'widget' => 'choice',
                'input'  => 'datetime',
            ])
            ->add('location', ChoiceType::class, [
                'choices' => [
                    'Den Haag' => 'Den Haag',
                    'Delft' => 'Delft',
                ],
            ])
            ->add('max_persons')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lesson::class,
        ]);
    }

    private function getTrainers()
    {
        $repository = $this->entityManager->getRepository(User::class);

        return $repository->createQueryBuilder('u')
            ->where('u.roles LIKE :role')
            ->setParameter('role', '%ROLE_TRAINER%')
            ->getQuery()
            ->getResult();
    }
}
