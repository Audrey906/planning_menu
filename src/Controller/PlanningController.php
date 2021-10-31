<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\DishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanningController extends AbstractController
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepo;

    /**
     * @var DishRepository
     */
    private $dishRepo;

    public function __construct(CategoryRepository $categoryRepo, DishRepository $dishRepo)
    {
        $this->categoryRepo = $categoryRepo;
        $this->dishRepo = $dishRepo;
    }

    /**
     * @Route("/planning", name="planning")
     */
    public function index(): Response
    {
        $categories = $this->categoryRepo->findBy(['category_visible' => 1]);
        $dishes = $this->dishRepo->findAll(['user' => $this->getUser()]);

        return $this->render('planning/index.html.twig', [
            'dishes' => $dishes,
            'categories' => $categories,
            'controller_name' => 'PlanningController',
        ]);
    }
}
