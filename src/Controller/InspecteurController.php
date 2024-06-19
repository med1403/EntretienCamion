<?php

namespace App\Controller;

use App\Entity\Inspecteur;
use App\Form\InspecteurType;
use App\Repository\InspecteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/inspecteur')]
class InspecteurController extends AbstractController
{
    #[Route('/', name: 'app_inspecteur_index', methods: ['GET'])]
    public function index(InspecteurRepository $inspecteurRepository): Response
    {
        return $this->render('inspecteur/index.html.twig', [
            'inspecteurs' => $inspecteurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_inspecteur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $inspecteur = new Inspecteur();
        $form = $this->createForm(InspecteurType::class, $inspecteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($inspecteur);
            $entityManager->flush();

            return $this->redirectToRoute('app_inspecteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('inspecteur/new.html.twig', [
            'inspecteur' => $inspecteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_inspecteur_show', methods: ['GET'])]
    public function show(Inspecteur $inspecteur): Response
    {
        return $this->render('inspecteur/show.html.twig', [
            'inspecteur' => $inspecteur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_inspecteur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Inspecteur $inspecteur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InspecteurType::class, $inspecteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_inspecteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('inspecteur/edit.html.twig', [
            'inspecteur' => $inspecteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_inspecteur_delete', methods: ['POST'])]
    public function delete(Request $request, Inspecteur $inspecteur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inspecteur->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($inspecteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_inspecteur_index', [], Response::HTTP_SEE_OTHER);
    }
}
