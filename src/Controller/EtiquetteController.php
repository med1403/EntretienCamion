<?php

namespace App\Controller;

use App\Entity\Etiquette;
use App\Form\EtiquetteType;
use App\Repository\EtiquetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/etiquette')]
class EtiquetteController extends AbstractController
{
    #[Route('/', name: 'etiquette_list')]
    public function list(EtiquetteRepository $etiquetteRepository): Response
    {
        $etiquettes = $etiquetteRepository->findAllEtiquettes();

        return $this->render('etiquette/list.html.twig', [
            'etiquettes' => $etiquettes,
        ]);
    }

    //Fonction pour ajouter une étiquette
    #[Route('/ajouter', name: 'ajouter')]
    public function ajoutezEtiquette(EntityManagerInterface $entityManager, Request $request): Response
    {
        //Instentiation de la classe Etiquette
        $etiquette = new Etiquette();
        //Création du formulaire
        $form = $this->createForm(EtiquetteType::class, $etiquette);
        //Envois du formulaire à la methode post pour examiner sa validation
        $form->handleRequest($request);
        //Verifions la crédibilité du formulaire avant d'inserer ces information dans la base de donnée
        if($form->isSubmitted() && $form->isValid())
        {
            //Fais des instruction en rapport avec le code
            //By Fod Kerfala Camara 17/06/24
            
            //Insertion dans la base de donnée
            $entityManager->persist($etiquette);
            //Execution de la requête
            $entityManager->flush();
            
            //On lui redirrige  à la page liste des étiquette
            return $this->redirectToRoute('etiquette_list');
        }


        return $this->render('etiquette/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit/{id}', name: 'etiquette_edit')]
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

    #[Route('/search', name: 'etiquette_search')]
    public function search(Request $request, EtiquetteRepository $etiquetteRepository): Response
    {
        $criteria = $request->query->all();
        $etiquettes = $etiquetteRepository->searchEtiquettes($criteria);

        return $this->render('etiquette/list.html.twig', [
            'etiquettes' => $etiquettes,
        ]);
    }
}
