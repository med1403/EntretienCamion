<?php

namespace App\Controller;

use App\Entity\Graissage;
use App\Form\GraissageType;
use App\Repository\GraissageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/graissage')]
class GraissageController extends AbstractController
{
    #[Route('/', name: 'app_graissage_index', methods: ['GET'])]
    public function index(Request $request, GraissageRepository $graissageRepository): Response
{
    $search = $request->query->get('search');
    $graissages = $search 
        ? $graissageRepository->createQueryBuilder('g')
            ->where('g.dateGraissage LIKE :search OR g.kmGraissage LIKE :search')
            ->setParameter('search', '%'.$search.'%')
            ->getQuery()
            ->getResult()
        : $graissageRepository->findAll();

    return $this->render('graissage/index.html.twig', [
        'graissages' => $graissages, // Utiliser $graissages au lieu de $graissageRepository->findAll()
    ]);
}


    #[Route('/new', name: 'app_graissage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $graissage = new Graissage();
        $form = $this->createForm(GraissageType::class, $graissage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($graissage);
            $entityManager->flush();

            return $this->redirectToRoute('app_graissage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('graissage/new.html.twig', [
            'graissage' => $graissage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_graissage_show', methods: ['GET'])]
    public function show(Graissage $graissage): Response
    {
        return $this->render('graissage/show.html.twig', [
            'graissage' => $graissage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_graissage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Graissage $graissage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GraissageType::class, $graissage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_graissage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('graissage/edit.html.twig', [
            'graissage' => $graissage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_graissage_delete', methods: ['POST'])]
    public function delete(Request $request, Graissage $graissage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$graissage->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($graissage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_graissage_index', [], Response::HTTP_SEE_OTHER);
    }
}
