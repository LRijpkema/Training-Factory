<?php

namespace App\Controller;

use App\Entity\Training;
use App\Form\TrainingType;
use App\Repository\TrainingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admintrianing' )]
class TrainingController extends AbstractController
{
    #[Route('/', name: 'app_admintraining', methods: ['GET'])]
    public function index(TrainingRepository $trainingRepository): Response
    {
        return $this->render('admin/training.html.twig', [
            'trainings' => $trainingRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_training_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TrainingRepository $trainingRepository): Response
    {
        $training = new Training();
        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trainingRepository->save($training, true);

            return $this->redirectToRoute('app_admintraining', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('training/new.html.twig', [
            'training' => $training,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_training_show', methods: ['GET'])]
    public function show(Training $training): Response
    {
        return $this->render('training/show.html.twig', [
            'training' => $training,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_training_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Training $training, TrainingRepository $trainingRepository): Response
    {
        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trainingRepository->save($training, true);

            return $this->redirectToRoute('app_admintraining', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('training/edit.html.twig', [
            'training' => $training,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_training_delete', methods: ['POST'])]
    public function delete(Request $request, Training $training, TrainingRepository $trainingRepository, EntityManagerInterface $entityManager): Response
    {
        foreach ($training->getLessons() as $lesson) {
            // Remove associated registrations
            foreach ($lesson->getRegistrations() as $registration) {
                $entityManager->remove($registration);
            }
            $entityManager->remove($lesson);
        }

        $entityManager->remove($training);
        $entityManager->flush();

        return $this->redirectToRoute('app_admintraining', [], Response::HTTP_SEE_OTHER);
    }
}
