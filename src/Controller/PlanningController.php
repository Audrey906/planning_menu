<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Entity\PlanningMenu;
use App\Repository\DayRepository;
use App\Entity\PlanningMenuDetail;
use App\Repository\DishRepository;
use App\Repository\PeriodRepository;
use App\Manager\PlanningDetailManager;
use App\Manager\PlanningManager;
use App\Repository\CategoryRepository;
use App\Repository\PlanningMenuDetailRepository;
use App\Repository\PlanningMenuRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    /**
     * @var PlanningDetailManager
     */
    private $planningDetailManager;

    /**
     * @var DayRepository
     */
    private $dayRepo;

    /**
     * @var PeriodRepository
     */
    private $periodRepo;

     /**
     * @var PlanningManager
     */
    private $planningManager;

    public function __construct(
        CategoryRepository $categoryRepo,
        DishRepository $dishRepo,
        PlanningDetailManager $planningDetailManager,
        DayRepository $dayRepo,
        PeriodRepository $periodRepo,
        PlanningManager $planningManager
        )
    {
        $this->categoryRepo = $categoryRepo;
        $this->dishRepo = $dishRepo;
        $this->planningDetailManager = $planningDetailManager;
        $this->dayRepo = $dayRepo;
        $this->periodRepo = $periodRepo;
        $this->planningManager = $planningManager;
    }

    /**
     * @Route("/planning", name="planning", methods={"GET"})
     */
    public function generator(): Response
    {
        $categories = $this->categoryRepo->findBy(['category_visible' => 1]);
        $dishes = $this->dishRepo->findBy(['user' => $this->getUser()], ['dish_name' => 'ASC']);
        $days = $this->dayRepo->findAll();

        return $this->render('planning/generator.html.twig', [
            'dishes' => $dishes,
            'categories' => $categories,
            'days' => $days,
        ]);
    }

    /**
     * @Route("/new", name="planning_new", methods={"POST"})
     */
    public function new(Request $request): Response
    {
        $requestedData = $request->request->all();

        $planning = $this->planningManager->persist($requestedData, $this->getUser());
        $this->planningDetailManager->persist($planning, $requestedData);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('planning_list', [], Response::HTTP_CREATED);
    }

    /**
     * @Route("/planning/list", name="planning_list")
     */
    public function planning_list(PlanningMenuRepository $planningRepo): Response
    {
       $planning = $planningRepo->findBy(['user' => $this->getUser()]);

        return $this->render('planning/list.html.twig', [
            'planning' => $planning,
        ]);
    }

     /**
     * @Route("/planning/{id}", name="planning_show")
     */
    public function show(PlanningMenu $planning): Response
    {
        $detail = $planning->getPlanningMenuDetails()->getValues();
        $dishes = $this->dishRepo->findBy(['user' => $this->getUser()], ['dish_name' => 'ASC']);
        $days = $this->dayRepo->findAll();

        return $this->render('planning/show.html.twig', [
            'planning' => $planning,
            'detail' => $detail,
            'dishes' => $dishes,
            'days' => $days,
        ]);
    }

    /**
     * @Route("/{id}", name="planning_delete", methods={"POST"})
     */
    public function delete(Request $request, PlanningMenu $planning): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planning->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($planning);
            $entityManager->flush();
        }

        return $this->redirectToRoute('planning_list', [], Response::HTTP_SEE_OTHER);
    }
}
