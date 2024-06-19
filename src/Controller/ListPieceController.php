<?php

namespace App\Controller;

use App\Entity\ListPiece;
use App\Form\ListPieceType;
use App\Repository\ListPieceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/list/piece')]
class ListPieceController extends AbstractController
{
    #[Route('/', name: 'app_list_piece_index', methods: ['GET'])]
    public function index(ListPieceRepository $listPieceRepository): Response
    {
        return $this->render('list_piece/index.html.twig', [
            'list_pieces' => $listPieceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_list_piece_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $listPiece = new ListPiece();
        $form = $this->createForm(ListPieceType::class, $listPiece);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($listPiece);
            $entityManager->flush();

            return $this->redirectToRoute('app_list_piece_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('list_piece/new.html.twig', [
            'list_piece' => $listPiece,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_list_piece_show', methods: ['GET'])]
    public function show(ListPiece $listPiece): Response
    {
        return $this->render('list_piece/show.html.twig', [
            'list_piece' => $listPiece,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_list_piece_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ListPiece $listPiece, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ListPieceType::class, $listPiece);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_list_piece_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('list_piece/edit.html.twig', [
            'list_piece' => $listPiece,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_list_piece_delete', methods: ['POST'])]
    public function delete(Request $request, ListPiece $listPiece, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$listPiece->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($listPiece);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_list_piece_index', [], Response::HTTP_SEE_OTHER);
    }
}
