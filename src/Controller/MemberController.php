<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Entity\Registration;
use App\Entity\User;
use App\Form\RegistrationType;
use App\Form\User1Type;
use App\Repository\LessonRepository;
use App\Repository\RegistrationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;


class MemberController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/member', name: 'app_member', methods: ['GET'])]
    public function memberHome(LessonRepository $lessonRepository, RegistrationRepository $registrationRepository): Response
    {
        $loggedInUser = $this->security->getUser();
        $lessons = $lessonRepository->findAll();
        $registrations = $registrationRepository->findAll();

        return $this->render('member/member.html.twig', [
            'lessons' => $lessons,
            'registrations' => $registrations,
            'user' => $loggedInUser,
        ]);
    }

    #[Route('/memberlessons', name: 'app_memberlessons')]
    public function memberLessons(LessonRepository $lessonRepository): Response
    {
        return $this->render('member/memberlessons.html.twig', [
            'lessons' => $lessonRepository->findAll(),
        ]);
    }


    #[Route('/memberregistration/{id}', name: 'app_memberregistration', methods: ['GET'])]
    public function memberRegistration( Request $request, $id, EntityManagerInterface $entityManager,): Response
    {
        $registration = new Registration();

        // Set the payment status
        $registration->setPayment(false);

        // Get the lesson and member (you may need to modify this based on your application logic)
        $lesson = $this->getDoctrine()->getRepository(Lesson::class)->find($id);

        $loggedInUser = $this->security->getUser();

        // Set the lesson and member for the registration
        $registration->setLesson($lesson);
        $registration->setMember($loggedInUser);

        // Persist the registration entity in the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($registration);
        $entityManager->flush();

        // Redirect or return a response
        return $this->redirectToRoute('app_member');
    }

    #[Route('/memberbetaling/{id}', name: 'app_memberbetaling', methods: ['GET'])]
    public function memberBetaling( Registration $registration, EntityManagerInterface $entityManager): Response
    {
        $registration->setPayment(true);
        $entityManager->flush();

        return $this->redirectToRoute('app_member');
    }


    #[Route('/memberregistrationdelete/{id}', name: 'app_memberregistrationdelete', methods: ['GET'])]
    public function memberRegistrationDelete( Registration $registration, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($registration);
        $entityManager->flush();

        return $this->redirectToRoute('app_member');
    }


    #[Route('/memberprofiel', name: 'app_memberprofiel')]
    public function memberProfiel(Request $request): Response
    {
        $user = $this->getUser(); // Get the currently logged-in user

        $form = $this->createForm(User1Type::class, $user); // Use User1Type form type

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_member');
        }

        return $this->render('member/memberprofiel.html.twig', [
            'form' => $form->createView(),
        ]);
    }



}
