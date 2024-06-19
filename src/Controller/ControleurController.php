<?php

namespace App\Controller;

use App\Entity\Controleur;
use App\Form\Controleur1Type;
use App\Repository\ControleurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/controleur')]
class ControleurController extends AbstractController
{
    #[Route('/', name: 'app_controleur_index', methods: ['GET'])]
    public function index(ControleurRepository $controleurRepository, Request $request): Response
    {
        $search = $request->query->get('search');
        $controleurs = $search 
            ? $controleurRepository->createQueryBuilder('c')
                ->where('c.nom LIKE :search OR c.numeroDeBadge LIKE :search')
                ->setParameter('search', '%'.$search.'%')
                ->getQuery()
                ->getResult()
            : $controleurRepository->findAll();

        return $this->render('controleur/index.html.twig', [
            'controleurs' => $controleurs,
        ]);
    }


    #[Route('/new', name: 'app_controleur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $controleur = new Controleur();
        $form = $this->createForm(Controleur1Type::class, $controleur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($controleur);
            $entityManager->flush();

            return $this->redirectToRoute('app_controleur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('controleur/new.html.twig', [
            'controleur' => $controleur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_controleur_show', methods: ['GET'])]
    public function show(Controleur $controleur): Response
    {
        return $this->render('controleur/show.html.twig', [
            'controleur' => $controleur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_controleur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Controleur $controleur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Controleur1Type::class, $controleur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_controleur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('controleur/edit.html.twig', [
            'controleur' => $controleur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_controleur_delete', methods: ['POST'])]
    public function delete(Request $request, Controleur $controleur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$controleur->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($controleur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_controleur_index', [], Response::HTTP_SEE_OTHER);
    }
}
