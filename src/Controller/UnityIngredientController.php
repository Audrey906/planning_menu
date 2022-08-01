<?php

namespace App\Controller;

use App\Entity\UnityIngredient;
use App\Form\UnityIngredientType;
use App\Repository\UnityIngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/unity/ingredient')]
class UnityIngredientController extends AbstractController
{
    #[Route('/', name: 'unity_ingredient_index', methods: ['GET'])]
    public function index(UnityIngredientRepository $unityIngredientRepository): Response
    {
        return $this->render('unity_ingredient/index.html.twig', [
            'unity_ingredients' => $unityIngredientRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'unity_ingredient_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $unityIngredient = new UnityIngredient();
        $form = $this->createForm(UnityIngredientType::class, $unityIngredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($unityIngredient);
            $entityManager->flush();

            return $this->redirectToRoute('unity_ingredient_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('unity_ingredient/new.html.twig', [
            'unity_ingredient' => $unityIngredient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'unity_ingredient_show', methods: ['GET'])]
    public function show(UnityIngredient $unityIngredient): Response
    {
        return $this->render('unity_ingredient/show.html.twig', [
            'unity_ingredient' => $unityIngredient,
        ]);
    }

    #[Route('/{id}/edit', name: 'unity_ingredient_edit', methods: ['GET','POST'])]
    public function edit(Request $request, UnityIngredient $unityIngredient): Response
    {
        $form = $this->createForm(UnityIngredientType::class, $unityIngredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('unity_ingredient_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('unity_ingredient/edit.html.twig', [
            'unity_ingredient' => $unityIngredient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'unity_ingredient_delete', methods: ['POST'])]
    public function delete(Request $request, UnityIngredient $unityIngredient): Response
    {
        if ($this->isCsrfTokenValid('delete'.$unityIngredient->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($unityIngredient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('unity_ingredient_index', [], Response::HTTP_SEE_OTHER);
    }
}
