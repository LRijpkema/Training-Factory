<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    #[Route('/admin', name: 'app_admin')]
    public function adminHome(): Response
    {
        $title = 'Admin Home';

        return $this->render('admin/admin.html.twig', [
            'title' => $title,
        ]);
    }

    #[Route('/admin/users', name: 'app_adminuser', methods: ['GET'])]
    public function adminUserCrud(UserRepository $userRepository): Response
    {
        return $this->render('admin/users.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/admin/crudtrainer', name: 'app_admincrudtrainers', methods: ['GET'])]
    public function adminTrainersCrud(UserRepository $userRepository): Response
    {
        return $this->render('admin/trainers.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
}
