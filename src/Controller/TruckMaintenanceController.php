<?php

namespace App\Controller;

use App\Entity\Controleur;
use App\Form\ControleurType;
use App\Repository\ControleurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/truck/maintenance')]
class TruckMaintenanceController extends AbstractController
{
    #[Route('/', name: 'truck_maintenance_index', methods: ['GET'])]
    public function index(ControleurRepository $controleurRepository): Response
    {
        return $this->render('truck_maintenance/index.html.twig', [
            'controleurs' => $controleurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'truck_maintenance_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $controleur = new Controleur();
        $form = $this->createForm(ControleurType::class, $controleur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($controleur);
            $entityManager->flush();

            return $this->redirectToRoute('truck_maintenance_index');
        }

        return $this->render('truck_maintenance/new.html.twig', [
            'controleur' => $controleur,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'truck_maintenance_show', methods: ['GET'])]
    public function show(Controleur $controleur): Response
    {
        return $this->render('truck_maintenance/show.html.twig', [
            'controleur' => $controleur,
        ]);
    }

    #[Route('/{id}/edit', name: 'truck_maintenance_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Controleur $controleur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ControleurType::class, $controleur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('truck_maintenance_index');
        }

        return $this->render('truck_maintenance/edit.html.twig', [
            'controleur' => $controleur,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'truck_maintenance_delete', methods: ['POST'])]
    public function delete(Request $request, Controleur $controleur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$controleur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($controleur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('truck_maintenance_index');
    }
}
