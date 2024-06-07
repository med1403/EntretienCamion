<?php

namespace App\Controller;

use App\Entity\Incident;
use App\Form\IncidentType;
use App\Repository\IncidentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IncidentController extends AbstractController
{
    #[Route('/incident/new', name: 'incident_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $incident = new Incident();
        $form = $this->createForm(IncidentType::class, $incident);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($incident);
            $entityManager->flush();

            return $this->redirectToRoute('incident_list');
        }

        return $this->render('incident/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/incident', name: 'incident_list')]
    public function list(IncidentRepository $incidentRepository): Response
    {
        $incidents = $incidentRepository->findAll();

        return $this->render('incident/list.html.twig', [
            'incidents' => $incidents,
        ]);
    }

    #[Route('/incident/{id}', name: 'incident_show')]
    public function show(Incident $incident): Response
    {
        return $this->render('incident/show.html.twig', [
            'incident' => $incident,
        ]);
    }

    #[Route('/incident/search', name: 'incident_search')]
    public function search(Request $request, IncidentRepository $incidentRepository): Response
    {
        $criteria = $request->query->get('criteria');
        $incidents = $incidentRepository->findByCriteria($criteria);

        return $this->render('incident/search.html.twig', [
            'incidents' => $incidents,
        ]);
    }
}
