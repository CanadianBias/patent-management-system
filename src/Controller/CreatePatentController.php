<?php

namespace App\Controller;

use App\Entity\File;
use App\Entity\Patent;
use App\Form\CreatePatentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        // Create new Patent instance
        $patent = new Patent();
        // Pass Patent to form
        $form = $this->createForm(CreatePatentType::class, $patent);
        // Handle request to grab form data
        $form->handleRequest($request);

        // Check if form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {
            // Get the data from the form
            $patent = $form->getData();
            // below actually adds the inventor to the patent object
            $patent->addInventor($this->getUser());

            // Handle file upload
            $files = $form->get('Files')->getData();
            // dd($files);
            // Check if any files were uploaded
            if ($files) {
                // Loop through each file
                foreach ($files as $file) {
                    // Create a new File instance
                    $fileEntity = new File();
                    // Save original file name as PHP gives it a unique name
                    $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    // Create a safe filename using the slugger
                    $safeFilename = $slugger->slug($originalFilename);
                    // Create a unique filename by appending a unique ID
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();
    
                    // Move the file to the directory where files are stored
                    try { 
                        $directory = $this->getParameter('kernel.project_dir') . '/public/uploads/';
                        $file->move($directory, $newFilename);
                    } catch (FileException $e) {
                        // Handle exception if something happens during file upload
                        dd($e);
                    }

                    // Set the new filename in the File entity
                    $fileEntity->setFilename($newFilename);
                    // Persist the file entity
                    $entityManager->persist($fileEntity);
                    // Set the patent for the file
                    $patent->addFile($fileEntity);
                }

            }

            // Persist the patent entity to the database
            $entityManager->persist($patent);
            // Flush the changes to the database
            $entityManager->flush();

            // Redirect user to view table page
            return $this->redirectToRoute('app_view_table');
        }

        return $this->render('create_patent/index.html.twig', [
            'form' => $form,
        ]);
    }
}
