<?php

namespace App\Controller;

use App\Entity\Patent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ViewPatentController extends AbstractController
{
    #[Route('/view/patent/{id}', name: 'app_view_patent')]
    public function show($id): Response
    {
        $patent = $this->getUser()->getPatents()->filter(function (Patent $patent) use ($id) {
            return $patent->getId() == $id;
        })->first();

        if (!$patent) {
            throw $this->createNotFoundException();
        } else {

            $dates = $patent->getPatentsHaveDates();

            return $this->render('view_patent/index.html.twig', [
                'patent' => $patent,
                'dates' => $dates,
            ]); 
        }
    }
}
