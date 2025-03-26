<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ViewTableController extends AbstractController
{
    #[Route('/view/table', name: 'app_view_table')]
    public function index(): Response // A repository would need to a parameter to the index method
    {

        $user = $this->getUser(); // This line is used to get the current user

        // This resulted in showing us that the relationship is not found in the ORM, but is in the database itself
        // dd($user->getPatents()); // This line is used to dump the patents of the current user

        // This worked???
        $patents = $user->getPatents();

        return $this->render('view_table/index.html.twig', [
            'patents' => $patents,
        ]);
    }
}
