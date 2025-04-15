<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; # Allows class to inherit from AbstractController
use Symfony\Component\HttpFoundation\Response; # Allows controller to return proper response to browser
use Symfony\Component\Routing\Attribute\Route; # Allows controller to reference URL

// This is a fairly simple controller that just returns the template, no other logic required at this time

class IndexController extends AbstractController # IndexController inherits AbstractController properties and methods
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        // See templates/index/index.html.twig
        $contents = $this->renderView('index/index.html.twig');

        return new Response($contents);
    }
}

?>