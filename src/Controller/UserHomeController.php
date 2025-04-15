<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// This is where the user lands after logging in. Every page under this one requires the use of accounts to access.
// This will probably have more logic as an overview section is added at a later point.

final class UserHomeController extends AbstractController
{
    #[Route('/user/home', name: 'app_user_home')]
    public function index(): Response
    {
        return $this->render('user_home/index.html.twig', [
            'controller_name' => 'UserHomeController',
        ]);
    }
}
