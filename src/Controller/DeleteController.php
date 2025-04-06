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

final class DeleteController extends AbstractController
{
    #[Route('/delete/date/{id}', name: 'app_delete_date')]
    public function deleteDate($id, EntityManagerInterface $entityManager): Response
    {
        // This route is used to delete a date from the database
        // The id is passed in the URL and is used to find the date in the database
        // The date is then removed from the database and the user is redirected to the patent view page

        $date = $entityManager->getRepository(Dates::class)->find($id);

        if (!$date) {
            throw $this->createNotFoundException('No date found for id ' . $id);
        }

        $entityManager->remove($date);
        $entityManager->flush();

        return $this->redirectToRoute('app_view_patent', ['id' => $date->getPatentId()->getId()]);
    }

    #[Route('/delete/file/{id}', name: 'app_delete_file')]
    public function deleteFile($id, EntityManagerInterface $entityManager): Response
    {
        // This route is used to delete a file from the database
        // The id is passed in the URL and is used to find the file in the database
        // The file is then removed from the database and the user is redirected to the patent view page

        $file = $entityManager->getRepository(File::class)->find($id);

        if (!$file) {
            throw $this->createNotFoundException('No file found for id ' . $id);
        }

        $entityManager->remove($file);
        $entityManager->flush();

        return $this->redirectToRoute('app_view_patent', ['id' => $file->getPatent()->getId()]);
    }

    #[Route('/delete/patent/{id}', name: 'app_delete_patent')]
    public function deletePatent($id, EntityManagerInterface $entityManager): Response
    {
        // This route is used to delete a patent from the database
        // The id is passed in the URL and is used to find the patent in the database
        // The patent is then removed from the database and the user is redirected to the patent view page

        $patent = $entityManager->getRepository(Patent::class)->find($id);

        if (!$patent) {
            throw $this->createNotFoundException('No patent found for id ' . $id);
        }

        $entityManager->remove($patent);
        $entityManager->flush();

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

        $entityManager->remove($inventor);
        $entityManager->flush();

        return $this->redirectToRoute('index');
    }
}
