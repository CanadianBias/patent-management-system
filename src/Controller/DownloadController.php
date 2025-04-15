<?php

namespace App\Controller;

use App\Repository\InventorRepository;
use App\Repository\FileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Attribute\Route;

// This controller handles file downloads, either files that the user uploaded with their patent, or a JSON file of their account information
// A standard for downloading the user data has not been made, it would be nice to have a predefined format

// In the future, it would be good to have an Upload controller where users can upload either this JSON file, or a different type of file with
// individual/multiple patent informaton and have the controller process this data into the database to help with data entry

final class DownloadController extends AbstractController
{
    #[Route('/download/file/{id}', name: 'app_download_file')]
    public function downloadFile($id, FileRepository $repo): BinaryFileResponse
    {
        // Grab the requested file with the id given in the URL, along with the id of the current user
        // function found in /src/Repository/FileRepository
        $file = $repo->findOneById($id, $this->getUser()->getId());
        // If the file is not found, or if it is not available to the current user
        if ($file === null) {
            throw $this->createNotFoundException('File not found');
        } else {
            // get the unique filename of the file
            $filepath = $file->getFilename();
        }
        // Create variable to store string of where uploaded files are stored
        $directory = $this->getParameter('kernel.project_dir') . '/public/uploads/';

        // Check if the file exists physically on the server, not just in the database
        if (!file_exists($directory . $filepath)) {
            throw $this->createNotFoundException('File not found');
        }

        // Returns a BinaryFileResponse pointing to the file
        // This should automatically download in the browser
        return $this->file($directory . $filepath);
    }

    #[Route('/download/user/{id}', name: 'app_download_user')]
    public function downloadUser($id, InventorRepository $repo): BinaryFileResponse
    {
        // grab inventor from database based off given id in URL
        $inventor = $repo->findOneById($id);
        // check if inventor exists and if user is current user
        if ($inventor === null || $inventor->getId() !== $this->getUser()->getId()) {
            throw $this->createNotFoundException('User not found');
        }
        // initialize filesystem, set current directory and new filename
        $filesystem = new Filesystem();
        $directory = $this->getParameter('kernel.project_dir') . '/public/uploads/';
        $filename = $inventor->getUsername() . '.json';
        // delete file if it currently exists
        if ($filesystem->exists($directory . $filename)) {
            $filesystem->remove($directory . $filename);
        }
        // create new file
        $filesystem->touch($directory . $filename);
        
        // write inventor data to file
        $filesystem->appendToFile($directory . $filename,
            json_encode([
                'username' => $inventor->getUsername(),
                'email' => $inventor->getEmail(),
                'firstName' => $inventor->getFirstName(),
                'lastName' => $inventor->getLastName(),
                'phoneNumber' => $inventor->getPhoneNumber(),
                'personType' => $inventor->getPersonType()->getName(),
            ]) . PHP_EOL . PHP_EOL . PHP_EOL
        );
        // grab inventor's patent list
        $patents = $inventor->getPatents();
        if ($patents !== null) {
            // write patent data to file
            foreach ($patents as $patent) {
                $filesystem->appendToFile($directory . $filename,
                    json_encode([
                        'patent' => [
                            'irn' => $patent->getIRN(),
                            'title' => $patent->getTitle(),
                            'description' => $patent->getDescript(),
                            'number' => $patent->getPatentNumber(),
                            'status' => $patent->getPatentsHaveStatus()->getStat(),
                            'category' => $patent->getPatentsAreCategorized()->getType(),
                            'language' => $patent->getPatentsHaveLanguage()->getName(),
                            'localization' => $patent->getPatentsHaveLocalization()->getType(),
                        ],
                    ]) . PHP_EOL
                );
                // write patent classification data to file
                foreach ($patent->getClassificationsList() as $class) {
                    $filesystem->appendToFile($directory . $filename,
                        json_encode([
                            'classification' => [
                                'code' => $class->getCode(),
                                'title' => $class->getTitle(),
                            ],
                        ]) . PHP_EOL
                    );
                }
                // write patent claim data to file
                foreach ($patent->getPatentsHaveClaims() as $claim) {
                    $filesystem->appendToFile($directory . $filename,
                        json_encode([
                            'claim' => [
                                'id' => $claim->getPatentId(),
                                'claim' => $claim->getClaim(),
                            ],
                        ]) . PHP_EOL
                    );
                }
                // write patent date data to file
                foreach ($patent->getPatentsHaveDates() as $date) {
                    $filesystem->appendToFile($directory . $filename,
                        json_encode([
                            'date' => [
                                'id' => $date->getPatentId(),
                                'dateShort' => $date->getDateShort()->format('Y-m-d'),
                                'dateLong' => $date->getDateLong()->format('Y-m-d'),
                                'gracePeriod' => $date->getGracePeriod()->format('Y-m-d'),
                                'type' => $date->getDatesHaveTypes()->getDateType(),
                            ],
                        ]) . PHP_EOL
                    );
                }
            }
        }
        // download file
        return $this->file($directory . $filename);
    }
}
