<?php

namespace App\Controller;

use App\Entity\File;
use App\Entity\Patent;
use App\Form\CreatePatentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

final class CreatePatentController extends AbstractController
{
    #[Route('/create/patent', name: 'app_create_patent')]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger, #[Autowire('%kernel.project_dir%/public/uploads')] string $directory): Response
    {
        $patent = new Patent();
        $form = $this->createForm(CreatePatentType::class, $patent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $patent = $form->getData();
            // below actually adds the inventor to the patent object
            $patent->addInventor($this->getUser());

            // Handle file upload
            $files = $form->get('Files')->getData();
            if ($files) {
                foreach ($files as $file) {
                    $fileEntity = new File();
                    $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();
    
                    try {
                        $file->move($directory, $newFilename);
                    } catch (FileException $e) {
                        // Handle exception if something happens during file upload
                    }

                    // Set the new filename in the File entity
                    $fileEntity->setFilename($newFilename);
                    // Persist the file entity
                    $entityManager->persist($fileEntity);
                    // Set the patent for the file
                    $patent->addFile($fileEntity);
                }

            }

            $entityManager->persist($patent);
            $entityManager->flush();

            return $this->redirectToRoute('app_view_table');
        }

        return $this->render('create_patent/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
