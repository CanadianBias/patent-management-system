<?php

namespace App\Controller;

use App\Repository\PatentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ViewTableController extends AbstractController
{
    #[Route('/view/table', name: 'app_view_table')]
    public function index(PatentRepository $repository): Response // A repository would need to a parameter to the index method
    {

        // Debug
        // $patents = $repository->findAll(); // This line is used to get all the patents from the database
        // dd($patents); // This line is used to dump the patents

        return $this->render('view_table/index.html.twig', [
            'patents' => $repository->findAll(),
        ]);
    }
}
