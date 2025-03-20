<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CreatePatentController extends AbstractController
{
    #[Route('/create/patent', name: 'app_create_patent')]
    public function index(): Response
    {
        return $this->render('create_patent/index.html.twig', [
            'controller_name' => 'CreatePatentController',
        ]);
    }
}
