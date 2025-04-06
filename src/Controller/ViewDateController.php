<?php

namespace App\Controller;

use App\Entity\Dates;
use App\Form\CreateDateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ViewDateController extends AbstractController
{
    // Controller used to edit dates when clicked on in ViewPatent controller
    #[Route('/view/date/{id}/edit', name: 'app_view_date_edit')]
    public function editDate($id, Dates $date, Request $request, EntityManagerInterface $em): Response
    {
        // CreateDateType is the form used to edit the date
        // Pass current date to the form
        $form = $this->createForm(CreateDateType::class, $date);
        $form->handleRequest($request);
        // Get the ID of the patent associated with the date
        $patentId = $date->getPatentID()->getId();
        
        // Check if the form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {
            // Flush the changes to the database
            $em->flush();
            // Redirect user to the view patent page of the associated patent
            return $this->redirectToRoute('app_view_patent', array('id' => $patentId));
        }

        return $this->render('view_date/index.html.twig', [
            'form' => $form->createView(),
            'id' => $patentId,
        ]);
    }
}
