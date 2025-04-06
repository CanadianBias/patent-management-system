<?php

namespace App\Controller;

use App\Repository\PatentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ViewTableController extends AbstractController
{
    #[Route('/view/table', name: 'app_view_table')]
    public function index(Request $request, PatentRepository $repository): Response // A repository would need to a parameter to the index method
    {

        $user = $this->getUser(); // This line is used to get the current user

        // This resulted in showing us that the relationship is not found in the ORM, but is in the database itself
        // dd($user->getPatents()); // This line is used to dump the patents of the current user

        // These are passed from JavaScript controller
        // Used to sort table of patents based off field and order
        $field = $request->query->get('sort');
        $order = $request->query->get('order');
        
        // If the field and order are null, return all patents
        if (is_null($field) || is_null($order))
        {
            $patents = $user->getPatents(); // return all patents
        } else 
        {
            // Get id of current user to pass to the repository
            $id = $user->getId();
            // Get patents of the current user, this will be overwritten if the field is valid
            $patents = $user->getPatents();
            // Call different method of repository based off field, pass it id of user and order
            switch($field) {
                case 'IRN':
                    $patents = $repository->returnPatentsByIRN($order, $id);
                    break;
                case 'Title':
                    $patents = $repository->returnPatentsByTitle($order, $id);
                    break;
                case 'PatentNumber':
                    $patents = $repository->returnPatentsByPatentNumber($order, $id);
                    break;
                case 'PatentsAreCategorized':
                    $patents = $repository->returnPatentsByCategory($order, $id);
                    break;
                case 'PatentsHaveLanguage':
                    $patents = $repository->returnPatentsByLanguage($order, $id);
                    break;
                case 'PatentsHaveLocalization':
                    $patents = $repository->returnPatentsByLocalization($order, $id);
                    break;
                case 'PatentsHaveStatus':
                    $patents = $repository->returnPatentsByStatus($order, $id);
                    break;
                default:
                    // $patents = $user->getPatents();
                    break;
            }
        }
        
        return $this->render('view_table/index.html.twig', [
            'patents' => $patents,
            'field' => $field,
            'order' => $order,
        ]);
    }
}
