<?php

namespace App\Controller;

use App\Entity\Patent;
use App\Form\CreatePatentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Security;

final class CreatePatentController extends AbstractController
{
    #[Route('/create/patent', name: 'app_create_patent')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $patent = new Patent();
        $form = $this->createForm(CreatePatentType::class, $patent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $patent = $form->getData();
            // below actually adds the inventor to the patent object
            $patent->addInventor($this->getUser());

            //dd($patent);

            $entityManager->persist($patent);
            $entityManager->flush();

            return $this->redirectToRoute('app_view_table');
        }

        return $this->render('create_patent/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
