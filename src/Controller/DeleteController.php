<?php

namespace App\Controller;

use App\Entity\Dates;
use App\Repository\DatesRepository;
use App\Entity\File;
use App\Repository\FileRepository;
use App\Entity\Patent;
use App\Repository\PatentRepository;
use App\Entity\Inventor;
use App\Repository\InventorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// This controller handles redirects from JavaScript controllers associated with different pages
// Each function is passed an id in the URL, which is checked against the current user to determine permissions for deletion

// Ideally, these pages would not be able to be typed into the browser and accessed, but this would require greater understanding of access control in Symfony

final class DeleteController extends AbstractController
{
    #[Route('/delete/date/{id}', name: 'app_delete_date')]
    public function deleteDate($id, EntityManagerInterface $entityManager): Response
    {
        // This route is used to delete a date from the database
        // The id is passed in the URL and is used to find the date in the database
        // The date is then removed from the database and the user is redirected to the patent view page

        // temporary variable to check if patent is allowed to be edited by user
        $isAccessible = false;
        // pull up patent list of currently logged in user
        $patents = $this->getUser()->getPatents();
        // loop through all the patents
        foreach ($patents as $patent) {
            // get date list of each patent
            $dates = $patent->getPatentsHaveDates();
            // loop through each date
            foreach ($dates as $date) {
                // if this date is the same as in the URL
                if ($date->getId() == $id) {
                    // change variable and break loop
                    $isAccessible = true;
                    break;
                }
            }
        }

        // Throw exception if the patent is not accesible to the current user
        // We don't want to let them know that date id belongs to someone else, so we'll just give them a generic exception
        if (!$isAccessible) {
            throw $this->createNotFoundException('No date found for id ' . $id);
        }

        // Look in the Dates repository to find object
        $date = $entityManager->getRepository(Dates::class)->find($id);

        // If the above variable is false, throw the same exception as above
        if (!$date) {
            throw $this->createNotFoundException('No date found for id ' . $id);
        }

        // The below two methods remove the date and save the changes
        $entityManager->remove($date);
        $entityManager->flush();

        // Redirect the user back to the patent they were originally on
        return $this->redirectToRoute('app_view_patent', ['id' => $date->getPatentId()->getId()]);
    }

    #[Route('/delete/file/{id}', name: 'app_delete_file')]
    public function deleteFile($id, EntityManagerInterface $entityManager): Response
    {
        // This route is used to delete a file from the database
        // The id is passed in the URL and is used to find the file in the database
        // The file is then removed from the database and the user is redirected to the patent view page

        // This is similar logic to removing dates
        // If the file is not related to the current user,
        // don't allow for the file to be deleted
        $isAccessible = false;
        $patents = $this->getUser()->getPatents();
        foreach ($patents as $patent) {
            $files = $patent->getFiles();
            foreach ($files as $file) {
                if ($file->getId() == $id) {
                    $isAccessible = true;
                    break;
                }
            }
        }

        if (!$isAccessible) {
            throw $this->createNotFoundException('No file found for id ' . $id);
        }

        $file = $entityManager->getRepository(File::class)->find($id);

        // Check if the file exists
        if (!$file) {
            throw $this->createNotFoundException('No file found for id ' . $id);
        }

        // Get the file name and path
        $filename = $file->getFilename();
        $directory = $this->getParameter('kernel.project_dir') . '/public/uploads/';
        $filePath = $directory . $filename;

        // Remove file entity from database
        $entityManager->remove($file);
        $entityManager->flush();

        // Delete the file from the server
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Redirect to the patent page that this file used to belong to
        return $this->redirectToRoute('app_view_patent', ['id' => $file->getPatent()->getId()]);
    }

    #[Route('/delete/patent/{id}', name: 'app_delete_patent')]
    public function deletePatent($id, EntityManagerInterface $entityManager): Response
    {
        // This route is used to delete a patent from the database
        // The id is passed in the URL and is used to find the patent in the database
        // The patent is then removed from the database and the user is redirected to the patent view page

        // If deleting a specific patent, we need to make sure we're deleting all related files and dates
        $patent = $entityManager->getRepository(Patent::class)->find($id);
        $dates = $patent->getPatentsHaveDates();
        $files = $patent->getFiles();

        // Check if the patent exists
        if (!$patent) {
            throw $this->createNotFoundException('No patent found for id ' . $id);
        }

        $isAccessible = false;

        // Check through all inventors associated with the patent, and check if the current user is one of them
        // In the future, when patents truely can have multiple inventors, there should be some way of distinguishing who has permission
        // to delete patents and who can simply view them, which requires a composite entity like there is for Patents and Classifications
        foreach ($patent->getInventors() as $inventor) {
            if ($inventor->getId() == $this->getUser()->getId()) {
                $isAccessible = true;
                break;
            }
        }

        if (!$isAccessible) {
            throw $this->createNotFoundException('No patent found for id ' . $id);
        }

        // Remove all dates associated with the patent
        foreach ($dates as $date) {
            $this->deleteDate($date->getId(), $entityManager);
        }

        // Remove all files associated with the patent
        foreach ($files as $file) {
            $this->deleteFile($file->getId(), $entityManager);
        }

        // Remove the patent entity from the database
        $entityManager->remove($patent);
        $entityManager->flush();

        // Redirect the user to the table view page
        return $this->redirectToRoute('app_view_table');
    }

    #[Route('/delete/inventor/{id}', name: 'app_delete_inventor')]
    public function deleteUser($id, EntityManagerInterface $entityManager): Response
    {
        // This route is used to delete an inventor from the database
        // The id is passed in the URL and is used to find the inventor in the database
        // The inventor is then removed from the database and the user is redirected to the patent view page

        $inventor = $entityManager->getRepository(Inventor::class)->find($id);

        if (!$inventor) {
            throw $this->createNotFoundException('No inventor found for id ' . $id);
        }

        // Check if the inventor is the current user
        if ($inventor->getId() !== $this->getUser()->getId()) {
            throw $this->createAccessDeniedException('No inventor found for id ' . $id);
        }

        $entityManager->remove($inventor);
        $entityManager->flush();

        return $this->redirectToRoute('index');
    }
}
