<?php

namespace App\Controller;

use App\Entity\Inspection;
use App\Form\InspectionType;
use App\Repository\InspectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/inspection')]
class InspectionController extends AbstractController
{
    #[Route('/', name: 'app_inspection_index', methods: ['GET'])]
    public function index(Request $request, InspectionRepository $inspectionRepository): Response
    {
        $search = $request->query->get('search');
        $inspections = $search 
            ? $inspectionRepository->createQueryBuilder('i')
                ->leftJoin('i.camion', 'c') // If you want to search by camion fields as well
                ->leftJoin('i.inspecteur', 'insp') // If you want to search by inspecteur fields as well
                ->where('i.commentaire LIKE :search')
                ->orWhere('i.dateInspection LIKE :search')
                ->orWhere('i.resultat LIKE :search')
                ->orWhere('c.remorque LIKE :search')  // Assuming 'name' is the correct field name in Inspecteur entity
                ->setParameter('search', '%'.$search.'%')
                ->getQuery()
                ->getResult()
            : $inspectionRepository->findAll();
        
        return $this->render('inspection/index.html.twig', [
            'inspections' => $inspections,
        ]);
    }


    #[Route('/new', name: 'app_inspection_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $inspection = new Inspection();
        $form = $this->createForm(InspectionType::class, $inspection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($inspection);
            $entityManager->flush();

            return $this->redirectToRoute('app_inspection_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('inspection/new.html.twig', [
            'inspection' => $inspection,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_inspection_show', methods: ['GET'])]
    public function show(Inspection $inspection): Response
    {
        return $this->render('inspection/show.html.twig', [
            'inspection' => $inspection,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_inspection_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Inspection $inspection, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InspectionType::class, $inspection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_inspection_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('inspection/edit.html.twig', [
            'inspection' => $inspection,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_inspection_delete', methods: ['POST'])]
    public function delete(Request $request, Inspection $inspection, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inspection->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($inspection);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_inspection_index', [], Response::HTTP_SEE_OTHER);
    }
}
