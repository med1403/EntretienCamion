<?php

namespace App\Controller;

use App\Entity\GradeVidenge;
use App\Form\GradeVidengeType;
use App\Repository\GradeVidengeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/grade/videnge')]
class GradeVidengeController extends AbstractController
{
    #[Route('/', name: 'app_grade_videnge_index', methods: ['GET'])]
    public function index(GradeVidengeRepository $gradeVidengeRepository): Response
    {
        return $this->render('grade_videnge/index.html.twig', [
            'grade_videnges' => $gradeVidengeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_grade_videnge_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $gradeVidenge = new GradeVidenge();
        $form = $this->createForm(GradeVidengeType::class, $gradeVidenge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($gradeVidenge);
            $entityManager->flush();

            return $this->redirectToRoute('app_grade_videnge_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('grade_videnge/new.html.twig', [
            'grade_videnge' => $gradeVidenge,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_grade_videnge_show', methods: ['GET'])]
    public function show(GradeVidenge $gradeVidenge): Response
    {
        return $this->render('grade_videnge/show.html.twig', [
            'grade_videnge' => $gradeVidenge,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_grade_videnge_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GradeVidenge $gradeVidenge, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GradeVidengeType::class, $gradeVidenge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_grade_videnge_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('grade_videnge/edit.html.twig', [
            'grade_videnge' => $gradeVidenge,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_grade_videnge_delete', methods: ['POST'])]
    public function delete(Request $request, GradeVidenge $gradeVidenge, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gradeVidenge->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($gradeVidenge);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_grade_videnge_index', [], Response::HTTP_SEE_OTHER);
    }
}
