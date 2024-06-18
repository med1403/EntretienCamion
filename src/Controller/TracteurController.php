<?php

namespace App\Controller;

use App\Entity\Tracteur;
use App\Form\TracteurType;
use App\Repository\TracteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/tracteur')]
class TracteurController extends AbstractController
{
    #[Route('/', name: 'app_tracteur_index', methods: ['GET'])]
    public function index(TracteurRepository $tracteurRepository): Response
    {
        return $this->render('tracteur/index.html.twig', [
            'tracteurs' => $tracteurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tracteur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tracteur = new Tracteur();
        $form = $this->createForm(TracteurType::class, $tracteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tracteur);
            $entityManager->flush();

            return $this->redirectToRoute('app_tracteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tracteur/new.html.twig', [
            'tracteur' => $tracteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tracteur_show', methods: ['GET'])]
    public function show(Tracteur $tracteur): Response
    {
        return $this->render('tracteur/show.html.twig', [
            'tracteur' => $tracteur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tracteur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tracteur $tracteur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TracteurType::class, $tracteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tracteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tracteur/edit.html.twig', [
            'tracteur' => $tracteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tracteur_delete', methods: ['POST'])]
    public function delete(Request $request, Tracteur $tracteur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tracteur->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($tracteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tracteur_index', [], Response::HTTP_SEE_OTHER);
    }
}
