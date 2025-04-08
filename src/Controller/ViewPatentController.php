<?php

namespace App\Controller;

use App\Entity\Patent;
use App\Entity\File;
use App\Form\CreatePatentType;
use App\Repository\DatesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

final class ViewPatentController extends AbstractController
{
    // Conditional route to view patents based off their id in the table
    #[Route('/view/patent/{id}', name: 'app_view_patent')]
    public function show($id, Request $request, DatesRepository $repository): Response
    {
        // Grab the patent that corresponds to the id, ensuring that the user is in that patent's Inventors list
        $patent = $this->getUser()->getPatents()->filter(function (Patent $patent) use ($id) {
            return $patent->getId() == $id;
        })->first();

        $files = $patent->getFiles();

        // These variables are used to sort the dates in the table
        // They are generated from event listeners in JavaScript controller
        // See /assets/controllers/patent_controller.js
        $field = $request->query->get('sort');
        $order = $request->query->get('order');

        // If the patent is a false value, then the user is not in the patent's Inventors list
        // and they are not allowed to view the patent
        if (!$patent) {
            throw $this->createNotFoundException();
        } else {
            // If the field and order are null, then the user is not trying to sort the table
            if (is_null($field) || is_null($order))
            {
                // return all the dates sorted as they are in the database
                $dates = $patent->getPatentsHaveDates();

            } else
            {
                // grab the patent id to pass to the repository
                $patentId = $patent->getId();
                // grab all the dates that correspond to the patent
                // this line will be overwritten by the switch statement
                $dates = $patent->getPatentsHaveDates();
                // Call the repository functions based off the field, pass each function the order
                switch ($field) {
                    case 'DatesHaveTypes':
                        $dates = $repository->returnDatesByType($order, $patentId);
                        break;
                    case 'DateShort':
                        $dates = $repository->returnDatesByDateShort($order, $patentId);
                        break;
                    case 'DateLong':
                        $dates = $repository->returnDatesByDateLong($order, $patentId);
                        break;
                    case 'GracePeriod':
                        $dates = $repository->returnDatesByGracePeriod($order, $patentId);
                        break;
                    default:
                        break;
                }
            }
            // pass patent info, dates info, field, and order to the template
            // This is used to sort the table in the template
            return $this->render('view_patent/index.html.twig', [
                'patent' => $patent,
                'dates' => $dates,
                'field' => $field,
                'order' => $order,
                'files' => $files,
            ]);
        }
    }

    // Route to edit the patent
    #[Route('/view/patent/{id}/edit', name: 'app_view_patent_edit')]
    public function edit($id, Patent $patent, Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        // Call the patent form and pass the current patent to it
        $form = $this->createForm(CreatePatentType::class, $patent);
        $form->handleRequest($request);

        // Check if form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {
            $patent = $form->getData();
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
            // Flush the changes to the database
            $entityManager->flush();
            // Redirect user to view patent page of changed patent
            return $this->redirectToRoute('app_view_patent', array('id' => $id));
            // return $this->redirectToRoute('app_view_table');
        }

        return $this->render('view_patent/edit.html.twig', [
            'form' => $form->createView(),
            'id' => $id,
        ]);
    }
}
