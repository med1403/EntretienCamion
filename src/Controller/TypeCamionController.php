<?php

namespace App\Controller;

use App\Entity\TypeCamion;
use App\Form\TypeCamionType;
use App\Repository\TypeCamionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/type/camion')]
class TypeCamionController extends AbstractController
{
    #[Route('/', name: 'app_type_camion_index', methods: ['GET'])]
    public function index(TypeCamionRepository $typeCamionRepository): Response
    {
        return $this->render('type_camion/index.html.twig', [
            'type_camions' => $typeCamionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_camion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeCamion = new TypeCamion();
        $form = $this->createForm(TypeCamionType::class, $typeCamion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeCamion);
            $entityManager->flush();

            return $this->redirectToRoute('app_type_camion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_camion/new.html.twig', [
            'type_camion' => $typeCamion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_camion_show', methods: ['GET'])]
    public function show(TypeCamion $typeCamion): Response
    {
        return $this->render('type_camion/show.html.twig', [
            'type_camion' => $typeCamion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_camion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeCamion $typeCamion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeCamionType::class, $typeCamion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_type_camion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_camion/edit.html.twig', [
            'type_camion' => $typeCamion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_camion_delete', methods: ['POST'])]
    public function delete(Request $request, TypeCamion $typeCamion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeCamion->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($typeCamion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_type_camion_index', [], Response::HTTP_SEE_OTHER);
    }
}
