<?php

namespace App\Controller;

use App\Entity\Reparation;
use App\Form\ReparationType;
use App\Repository\ReparationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReparationController extends AbstractController
{
    #[Route('/reparation/new', name: 'reparation_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reparation = new Reparation();
        $form = $this->createForm(ReparationType::class, $reparation);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reparation);
            $entityManager->flush();

            return $this->redirectToRoute('reparation_list');
        }

        return $this->render('reparation/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/reparation', name: 'reparation_list')]
    public function list(ReparationRepository $reparationRepository): Response
    {
        $reparations = $reparationRepository->findAll();

        return $this->render('reparation/list.html.twig', [
            'reparations' => $reparations,
        ]);
    }

    #[Route('/reparation/{id}', name: 'reparation_show', requirements: ['id' => '\d+'])]
    public function show(Reparation $reparation): Response
    {
        return $this->render('reparation/show.html.twig', [
            'reparation' => $reparation,
        ]);
    }

   /* #[Route('/reparation/search', name: 'reparation_search')]
    public function search(Request $request, ReparationRepository $reparationRepository): Response
    {
        $criteria = $request->query->get('criteria');
        $reparations = $reparationRepository->findByCriteria($criteria);

        return $this->render('reparation/search.html.twig', [
            'reparations' => $reparations,
        ]);
    }*/

    #[Route('/reparation/search', name: 'reparation_search')]
    public function search(Request $request, ReparationRepository $reparationRepository): Response
    {
        $criteria = $request->query->get('criteria');
        $reparations = [];

        if ($criteria) {
            $reparations = $reparationRepository->findByDescription($criteria);
        }

        return $this->render('reparation/search.html.twig', [
            'reparations' => $reparations,
            'criteria' => $criteria,
        ]);
    }
}
