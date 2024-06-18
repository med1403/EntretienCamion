<?php

namespace App\Controller;

use App\Entity\Camion;
use App\Form\CamionType;
use App\Repository\CamionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/camion')]
class CamionController extends AbstractController
{
    #[Route('/', name: 'app_camion_index', methods: ['GET'])]
    public function index(CamionRepository $camionRepository): Response
    {
        return $this->render('camion/index.html.twig', [
            'camions' => $camionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_camion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $camion = new Camion();
        $form = $this->createForm(CamionType::class, $camion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Vérifier si les champs obligatoires sont vides
            if (!$camion->getTypeCamion() || !$camion->getTracteur() || !$camion->getCategorie()) {
                $this->addFlash('warning', 'Veuillez remplir tous les champs obligatoires.');
                return $this->redirectToRoute('app_camion_new');
            }
            $entityManager->persist($camion);
            $entityManager->flush();

            return $this->redirectToRoute('app_camion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('camion/new.html.twig', [
            'camion' => $camion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_camion_show', methods: ['GET'])]
    public function show(Camion $camion): Response
    {
        return $this->render('camion/show.html.twig', [
            'camion' => $camion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_camion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Camion $camion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CamionType::class, $camion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_camion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('camion/edit.html.twig', [
            'camion' => $camion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_camion_delete', methods: ['POST'])]
    public function delete(Request $request, Camion $camion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$camion->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($camion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_camion_index', [], Response::HTTP_SEE_OTHER);
    }
}
