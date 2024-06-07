<?php

namespace App\Controller;

use App\Entity\Incidence;
use App\Form\IncidentType;
use App\Repository\IncidenceRepository;
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
        $incidence = new Incidence();
        $form = $this->createForm(IncidentType::class, $incidence);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($incidence);
            $entityManager->flush();

            return $this->redirectToRoute('incident_list');
        }

        return $this->render('incident/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/incident', name: 'incident_list')]
    public function list(IncidenceRepository $incidenceRepository): Response
    {
        $incidences = $incidenceRepository->findAll();

        return $this->render('incident/list.html.twig', [
            'incidences' => $incidences,
        ]);
    }

    #[Route('/incident/{id}', name: 'incident_show', requirements: ['id' => '\d+'])]
    public function show(Incidence $incidence): Response
    {
        return $this->render('incident/show.html.twig', [
            'incidence' => $incidence,
        ]);
    }

    #[Route('/incident/search', name: 'incident_search')]
    public function search(Request $request, IncidenceRepository $incidenceRepository): Response
    {
        $criteria = $request->query->get('criteria');
        $incidences = $incidenceRepository->findByCriteria($criteria);

        return $this->render('incident/search.html.twig', [
            'incidences' => $incidences,
        ]);
    }
}
