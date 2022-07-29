<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Form\DishType;
use App\Repository\DishRepository;
use src\Exception\NotAuthaurized;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dish")
 */
class DishController extends AbstractController
{
    /**
     * @Route("/", name="dish_index", methods={"GET"})
     */
    public function index(DishRepository $dishRepository): Response
    {
        return $this->render('dish/index.html.twig', [
            'dishes' => $dishRepository->findBy(['user' => $this->getuser()], ['dish_name' => 'ASC']),
        ]);
    }

    /**
     * @Route("/new", name="dish_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dish = new Dish();
        $form = $this->createForm(DishType::class, $dish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dish->setUser($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dish);
            $entityManager->flush();

            $this->addFlash('success', sprintf('Le plat %s a bien été ajouté.', $dish->getDishName()));
            return $this->redirectToRoute('dish_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dish/new.html.twig', [
            'dish' => $dish,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="dish_show", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function show(Dish $dish): Response
    {
        if ($dish->getUser() !== $this->getUser()) {
            throw new NotAuthaurized('Vous n\'êtes pas autorisé à voir ce plat');
        }

        return $this->render('dish/show.html.twig', [
            'dish' => $dish,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dish_edit", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    public function edit(Request $request, Dish $dish): Response
    {
        if ($dish->getUser() !== $this->getUser()) {
            throw new NotAuthaurized('Vous n\'êtes pas autorisé à voir ce plat');
        }

        $form = $this->createForm(DishType::class, $dish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dish_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dish/edit.html.twig', [
            'dish' => $dish,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="dish_delete", requirements={"id"="\d+"}, methods={"POST"})
     */
    public function delete(Request $request, Dish $dish): Response
    {
        if ($dish->getUser() !== $this->getUser()) {
            throw new NotAuthaurized('Vous n\'êtes pas autorisé à voir ce plat');
        }

        if ($this->isCsrfTokenValid('delete'.$dish->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dish);
            $entityManager->flush();
        }

        $this->addFlash('success-delete', sprintf('Le plat %s a bien été supprimé.', $dish->getDishName()));
        return $this->redirectToRoute('dish_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/all", name="dish_index_all", methods={"GET"})
     */
    public function indexAll(DishRepository $dishRepository): Response
    {
        return $this->render('dish/index.html.twig', [
            'dishes' => $dishRepository->findAll(),
        ]);
    }
}
