<?php

namespace App\Controller;

use App\Entity\Patent;
use App\Repository\DatesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ViewPatentController extends AbstractController
{
    #[Route('/view/patent/{id}', name: 'app_view_patent')]
    public function show($id, Request $request, DatesRepository $repository): Response
    {
        $patent = $this->getUser()->getPatents()->filter(function (Patent $patent) use ($id) {
            return $patent->getId() == $id;
        })->first();
        
        $field = $request->query->get('sort');
        $order = $request->query->get('order');

        if (!$patent) {
            throw $this->createNotFoundException();
        } else {

            if (is_null($field) || is_null($order))
            {
                $dates = $patent->getPatentsHaveDates();

            } else 
            {
                $patentId = $patent->getId();
                $dates = $patent->getPatentsHaveDates();
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
            return $this->render('view_patent/index.html.twig', [
                'patent' => $patent,
                'dates' => $dates,
                'field' => $field,
                'order' => $order,
            ]); 
        }
    }
}
