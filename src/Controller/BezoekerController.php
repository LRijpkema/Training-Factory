<?php

// src/Controller/BezoekerController.php
namespace App\Controller;

use App\Entity\Training;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BezoekerController extends AbstractController
{
    #[Route('/')]
    public function bezoekerHome(EntityManagerInterface $entityManager): Response
    {
        $trainings = $entityManager->getRepository(Training::class)->findAll();

        if (!$trainings) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $title = 'Home';

        return $this->render('bezoeker/bezoeker.html.twig', [
            'title' => $title, 'trainings' => $trainings,
        ]);
    }

    #[Route('/sporten')]
    public function bezoekerSporten(EntityManagerInterface $entityManager): Response
    {
        $trainings = $entityManager->getRepository(Training::class)->findAll();

        if (!$trainings) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $title = 'Sporten';

        return $this->render('bezoeker/sporten.html.twig', [
            'title' => $title, 'trainings' => $trainings,
        ]);
    }

    #[Route('/regels')]
    public function bezoekerRegels(): Response
    {
        $title = 'Gedrags Regels';

        return $this->render('bezoeker/regels.html.twig', [
            'title' => $title,
        ]);
    }

    #[Route('/contact')]
    public function bezoekerContact(): Response
    {
        $title = 'Contact';

        return $this->render('bezoeker/contact.html.twig', [
            'title' => $title,
        ]);
    }



}
