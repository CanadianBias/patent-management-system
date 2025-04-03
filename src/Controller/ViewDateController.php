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
    #[Route('/view/date/{id}/edit', name: 'app_view_date_edit')]
    public function editDate($id, Dates $date, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CreateDateType::class, $date);
        $form->handleRequest($request);
        $patentId = $date->getPatentID()->getId();
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('app_view_patent', array('id' => $patentId));
        }

        return $this->render('view_date/index.html.twig', [
            'form' => $form->createView(),
            'id' => $patentId,
        ]);
    }
}
