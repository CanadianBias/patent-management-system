<?php

/*
    This was a trial controller to view all the languages in the database
    It is not used in the application but is left here for reference
    for using repositories to get data from the database
*/

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
