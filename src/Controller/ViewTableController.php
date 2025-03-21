<?php

namespace App\Controller;

use App\Repository\PatentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ViewTableController extends AbstractController
{
    #[Route('/view/table', name: 'app_view_table')]
    public function index(PatentRepository $repository): Response
    {

        $patents = $repository->findAll();

        dump($patents);

        return $this->render('view_table/index.html.twig', [
            'controller_name' => 'ViewTableController',
        ]);
    }
}
