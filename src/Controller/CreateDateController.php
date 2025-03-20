<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CreateDateController extends AbstractController
{
    #[Route('/create/date', name: 'app_create_date')]
    public function index(): Response
    {
        return $this->render('create_date/index.html.twig', [
            'controller_name' => 'CreateDateController',
        ]);
    }
}
