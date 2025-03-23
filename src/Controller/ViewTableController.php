<?php

namespace App\Controller;

use App\Entity\Patent;
use App\Repository\PatentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ViewTableController extends AbstractController
{
    #[Route('/view/table', name: 'app_view_table')]
    public function index(PatentRepository $repository): Response // A repository would need to a parameter to the index method
    {

        $user = $this->getUser(); // This line is used to get the current user

        $patents = $repository->createQueryBuilder('p') // This line is used to create a query builder
            ->where('p.inventors = :user') // This line is used to filter the query
            ->setParameter('user', $user) // This line is used to set the parameter
            ->getQuery(); // This line is used to get the query

        // $patents = $repository->findAll();

        return $this->render('view_table/index.html.twig', [
            'patents' => $patents,
        ]);
    }
}
