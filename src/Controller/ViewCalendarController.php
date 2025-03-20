<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ViewCalendarController extends AbstractController
{
    #[Route('/view/calendar', name: 'app_view_calendar')]
    public function index(): Response
    {
        return $this->render('view_calendar/index.html.twig', [
            'controller_name' => 'ViewCalendarController',
        ]);
    }
}
