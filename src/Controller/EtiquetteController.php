<?php

namespace App\Controller;

use App\Entity\Etiquette;
use App\Form\EtiquetteType;
use App\Repository\EtiquetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtiquetteController extends AbstractController
{
    #[Route('/etiquette', name: 'etiquette_list')]
    public function list(EtiquetteRepository $etiquetteRepository): Response
    {
        $etiquettes = $etiquetteRepository->findAllEtiquettes();

        return $this->render('etiquette/list.html.twig', [
            'etiquettes' => $etiquettes,
        ]);
    }

    #[Route('/etiquette/edit/{id}', name: 'etiquette_edit')]
    public function edit(int $id, Request $request, EtiquetteRepository $etiquetteRepository): Response
    {
        $etiquette = $etiquetteRepository->findEtiquetteById($id);

        if (!$etiquette) {
            throw $this->createNotFoundException('L\'étiquette n\'existe pas.');
        }

        $form = $this->createForm(EtiquetteType::class, $etiquette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $etiquetteRepository->updateEtiquette($etiquette);

            return $this->redirectToRoute('etiquette_list');
        }

        return $this->render('etiquette/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/etiquette/search', name: 'etiquette_search')]
    public function search(Request $request, EtiquetteRepository $etiquetteRepository): Response
    {
        $criteria = $request->query->all();
        $etiquettes = $etiquetteRepository->searchEtiquettes($criteria);

        return $this->render('etiquette/list.html.twig', [
            'etiquettes' => $etiquettes,
        ]);
    }
}
