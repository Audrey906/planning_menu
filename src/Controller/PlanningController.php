<?php

namespace App\Controller;

use App\Entity\PlanningMenu;
use App\Entity\PlanningMenuDetail;
use App\Manager\PlanningDetailManager;
use App\Repository\CategoryRepository;
use App\Repository\DayRepository;
use App\Repository\DishRepository;
use App\Repository\PeriodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    public function __construct(
        CategoryRepository $categoryRepo,
        DishRepository $dishRepo,
        PlanningDetailManager $planningDetailManager,
        DayRepository $dayRepo,
        PeriodRepository $periodRepo)
    {
        $this->categoryRepo = $categoryRepo;
        $this->dishRepo = $dishRepo;
        $this->planningDetailManager = $planningDetailManager;
        $this->dayRepo = $dayRepo;
        $this->periodRepo = $periodRepo;
    }

    /**
     * @Route("/planning", name="planning",)
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

    /**
     * @Route("/new", name="planning_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $requestedData = $request->request->all();

        // add New planningMenu
        $planning = new PlanningMenu();
        $planning->setUser($this->getUser());
        $planning->setPlanningName($requestedData['planning-name']);
        $planning->setPlanningCreatedDate(new \DateTime());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($planning);
        $entityManager->flush();

        // add New planningMenuDetails
        $days = $this->dayRepo->findAll();
        foreach ($days as $k => $d) {
            $dayArray[$d->getId()] = $d;
        }

        $periods = $this->periodRepo->findAll();
        foreach ($periods as $k => $p) {
            $periodArray[$p->getId()] = $p;
        }

        $cats = $this->categoryRepo->findAll();
        foreach ($cats as $k => $c) {
            $catArray[$c->getId()] = $c;
        }

        foreach ($requestedData as $key => $data) {
            if ('planning-name' !== $key && '---' !== $data) {
                $explodeData = explode('_', $key);
                $planningDetail = new PlanningMenuDetail();
                $planningDetail->setWeekId($explodeData[0]);
                $planningDetail->setDay($dayArray[$explodeData[2]]);
                $planningDetail->setPeriod($periodArray[$explodeData[1]]);
                $planningDetail->setCategoryId($catArray[$explodeData[3]]);
                $planningDetail->setPlanningMenu($planning);
                $entityManager->persist($planningDetail);
                $entityManager->flush();
            }
        }

        return $this->redirectToRoute('dish_index', [], Response::HTTP_SEE_OTHER);
    }
}
