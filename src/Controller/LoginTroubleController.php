<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// If email verification was set up, this would be a page to request a password reset.
// This page requires use of an email server, which requires a fully registered domain name.
// As such, this is unfinished.

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
