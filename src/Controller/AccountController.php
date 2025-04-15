<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// Most of the logic on this page is actually either within /assests/controllers/account_controller.js
// or in the referenced Twig template

final class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(): Response
    {
        $userId = $this->getUser()->getId();
        return $this->render('account/index.html.twig', [
            'userId' => $userId,
        ]);
    }
}
