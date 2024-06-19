<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\Etiquette;
use App\Form\EtiquetteType;
use App\Repository\EtiquetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//Importation de la bibliothèque pour générer  
//le pdf pour faire l'impression
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

    //Implementation de la fonction pour faire le PDF ensuite faire l'impression
    #[Route('/imprimer/{id}', name: 'etiquette_imprimer')]
    public function imprimerEtiquette(EtiquetteRepository $etiquetteRepository, int $id): Response
    {
        $etiquette = $etiquetteRepository->find($id);//Je récupère l'id de l'étiquette passer
        //Ceci est codé par SOLO457: 19/06/2024 16:58
        if (!$etiquette) {
            //Fais des instructions en rapport avec le code
            //On lève une exception
            throw $this->createNotFoundException('ERREUR: L\'étiquette fournie est innexistante dans le système.');
        }

        // Configuration de la bibliothèque Dompdf 
        $pdfOptions = new Options();//Je crée une instance de la Options
        $pdfOptions->set('defaultFont', 'Arial');//Je fais la configuration par defaut avec le font

        //Je crée une instance de la classe DomPdfn et je lui passe l'objet $pdfOptions
        $dompdf = new Dompdf($pdfOptions);

        // Je fais appelle au fichier HTML qui dois afficher la sortie dans la vue
        $html = $this->renderView('etiquette/imprimer.html.twig', [
            'etiquette' => $etiquette,//On retourne l'étiquette spécifique  mprimer
        ]);

        // On charge le fichier HTML dans le Dompdf
        $dompdf->loadHtml($html);

        // Je donne l'orientation et la taille du papier à imprimer
        $dompdf->setPaper('A4', 'portrait');

        // J rends le HTML en PDF afin d'enlever le format HTML 
        $dompdf->render();

        /*
        Ici, stream() envoie le PDF généré directement vers le navigateur.
        L'option "Attachment" => false Va indiquer que le PDF doit être affiché dans le navigateur
        plutôt que téléchargé en tant que pièce jointe.
        */
        $dompdf->stream("etiquette_SOLO457.pdf", [
            "Attachment" => false
        ]);
        /*
         Cette instruction return envoie une réponse HTTP indiquant
         que le type de contenu est application/pdf.
         Cela va me permettre d'informer le navigateur,
         sur la manière de traiter la réponse.
        il s'attend à recevoir un fichier PDF.
         */
        return new Response('', 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}