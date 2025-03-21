<?php

namespace App\Controller;

use App\Repository\LanguageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ViewLanguagesController extends AbstractController
{
    #[Route('/view/languages', name: 'app_view_languages')]
    public function index(LanguageRepository $repository): Response
    {
        return $this->render('view_languages/index.html.twig', [
            'languages' => $repository->findAll(),
        ]);
    }
}
