<?php

namespace App\Controller;

use App\Entity\Dates;
use App\Form\CreateDateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CreateDateController extends AbstractController
{
    #[Route('/create/date', name: 'app_create_date')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Create new Date instance
        $date = new Dates();
        // Pass Date to form
        $form = $this->createForm(CreateDateType::class, $date);
        // Handle request to grab form data
        $form->handleRequest($request);

        // Check if form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {
            // Get the data from the form
            $date = $form->getData();

            // Persist the date entity to the database
            $entityManager->persist($date);
            // Flush the changes to the database
            $entityManager->flush();

            // Redirect user to view table page
            return $this->redirectToRoute('app_view_table');
        }

        return $this->render('create_date/index.html.twig', [
            'form' => $form,
        ]);
    }
}
