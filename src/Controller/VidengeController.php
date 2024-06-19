<?php

namespace App\Controller;

use App\Entity\Videnge;
use App\Form\VidengeType;
use App\Repository\VidengeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/videnge')]
class VidengeController extends AbstractController
{
    #[Route('/', name: 'app_videnge_index', methods: ['GET'])]
    public function index(VidengeRepository $videngeRepository): Response
    {
        return $this->render('videnge/index.html.twig', [
            'videnges' => $videngeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_videnge_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $videnge = new Videnge();
        $form = $this->createForm(VidengeType::class, $videnge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $videnge->setStatut(true);
            $entityManager->persist($videnge);
            $entityManager->flush();

            return $this->redirectToRoute('app_videnge_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('videnge/new.html.twig', [
            'videnge' => $videnge,
            'form' => $form,
        ]);
    }
    #[Route('/planifier', name: 'app_videnge_planifier', methods: ['GET', 'POST'])]
    public function planier(Request $request, EntityManagerInterface $entityManager): Response
    {
        $videnge = new Videnge();
        $form = $this->createForm(VidengeType::class, $videnge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $videnge->setStatut(false);
            $entityManager->persist($videnge);
            $entityManager->flush();

            return $this->redirectToRoute('app_videnge_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('videnge/planifier.html.twig', [
            'videnge' => $videnge,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_videnge_show', methods: ['GET'])]
    public function show(Videnge $videnge): Response
    {
        return $this->render('videnge/show.html.twig', [
            'videnge' => $videnge,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_videnge_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Videnge $videnge, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VidengeType::class, $videnge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_videnge_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('videnge/edit.html.twig', [
            'videnge' => $videnge,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_videnge_delete', methods: ['POST'])]
    public function delete(Request $request, Videnge $videnge, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$videnge->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($videnge);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_videnge_index', [], Response::HTTP_SEE_OTHER);
    }
}
