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
        $date = new Dates();
        $form = $this->createForm(CreateDateType::class, $date);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $date = $form->getData();

            $entityManager->persist($date);
            $entityManager->flush();

            return $this->redirectToRoute('app_view_table');
        }

        return $this->render('create_date/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
