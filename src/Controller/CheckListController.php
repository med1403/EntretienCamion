<?php
// src/Controller/ChecklistController.php
namespace App\Controller;

use App\Entity\Checklist;
use App\Form\ChecklistType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckListController extends AbstractController
{

    #[Route('/checklist', name: 'check_list')]
    public function checklist(): Response
    {
        return $this->render('checklist/checklist.html.twig', [
            'controller_name' => 'check_list',
        ]);
    }


    /**
     * @Route("/checklist/success", name="checklist_success")
     */
    public function success(): Response
    {
        return new Response('Checklist créée avec succès !');
    }
}
