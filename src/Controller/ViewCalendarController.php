<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// This page is a placeholder for things to come.
// It likely requires either complex logic to parse dates for all user patents into a calendar format, or the use of an external API,
// the later likely requiring a domain name.

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
