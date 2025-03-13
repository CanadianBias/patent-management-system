<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LoginTroubleController extends AbstractController
{
    #[Route('/login/trouble', name: 'app_login_trouble')]
    public function index(): Response
    {
        return $this->render('login_trouble/index.html.twig', [
            'controller_name' => 'LoginTroubleController',
        ]);
    }
}
