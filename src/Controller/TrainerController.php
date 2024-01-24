<?php

namespace App\Controller;

use App\Form\User1Type;
use App\Repository\LessonRepository;
use App\Repository\RegistrationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrainerController extends AbstractController
{
    #[Route('/trainer', name: 'app_trainer')]
    public function TrainerHome(): Response
    {
        $title = 'Contact';

        return $this->render('trainer/trainer.html.twig', [
            'controller_name' => 'TrainerController', 'title' => $title,
        ]);
    }



    #[Route('/trainerdeelnemers/{id}', name: 'app_trainerdeelnemers', methods: ['GET'])]
    public function TrainerDeelnemers(LessonRepository $lessonRepository, RegistrationRepository $registrationRepository, int $id): Response
    {
        $lesson = $lessonRepository->find($id);
        $registrations = $registrationRepository->findBy(['lesson' => $lesson]);

        return $this->render('trainer/deelnemers.html.twig', [
            'lesson' => $lesson,
            'registrations' => $registrations,
        ]);
    }

    #[Route('/trainerprofiel', name: 'app_trainerprofiel')]
    public function trainerProfiel(Request $request): Response
    {
        $user = $this->getUser(); // Get the currently logged-in user

        $form = $this->createForm(User1Type::class, $user); // Use User1Type form type

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_trainer');
        }

        return $this->render('trainer/profiel.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
