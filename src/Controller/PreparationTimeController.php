<?php

namespace App\Controller;

use App\Entity\PreparationTime;
use App\Form\PreparationTimeType;
use App\Repository\PreparationTimeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/preparation/time')]
class PreparationTimeController extends AbstractController
{
    #[Route('/', name: 'preparation_time_index', methods: ['GET'])]
    public function index(PreparationTimeRepository $preparationTimeRepository): Response
    {
        return $this->render('preparation_time/index.html.twig', [
            'preparation_times' => $preparationTimeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'preparation_time_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $preparationTime = new PreparationTime();
        $form = $this->createForm(PreparationTimeType::class, $preparationTime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($preparationTime);
            $entityManager->flush();

            return $this->redirectToRoute('preparation_time_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('preparation_time/new.html.twig', [
            'preparation_time' => $preparationTime,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'preparation_time_show', methods: ['GET'])]
    public function show(PreparationTime $preparationTime): Response
    {
        return $this->render('preparation_time/show.html.twig', [
            'preparation_time' => $preparationTime,
        ]);
    }

    #[Route('/{id}/edit', name: 'preparation_time_edit', methods: ['GET','POST'])]
    public function edit(Request $request, PreparationTime $preparationTime): Response
    {
        $form = $this->createForm(PreparationTimeType::class, $preparationTime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('preparation_time_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('preparation_time/edit.html.twig', [
            'preparation_time' => $preparationTime,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'preparation_time_delete', methods: ['POST'])]
    public function delete(Request $request, PreparationTime $preparationTime): Response
    {
        if ($this->isCsrfTokenValid('delete'.$preparationTime->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($preparationTime);
            $entityManager->flush();
        }

        return $this->redirectToRoute('preparation_time_index', [], Response::HTTP_SEE_OTHER);
    }
}
