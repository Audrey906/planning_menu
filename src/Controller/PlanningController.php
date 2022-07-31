<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Entity\PlanningMenu;
use App\Repository\DayRepository;
use App\Entity\PlanningMenuDetail;
use App\Repository\DishRepository;
use App\Repository\PeriodRepository;
use App\Manager\PlanningDetailManager;
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
        $dishes = $this->dishRepo->findBy(['user' => $this->getUser()], ['dish_name' => 'ASC']);
        $days = $this->dayRepo->findAll();

        return $this->render('planning/index.html.twig', [
            'dishes' => $dishes,
            'categories' => $categories,
            'controller_name' => 'PlanningController',
            'days' => $days,
        ]);
    }

    /**
     * @Route("/new", name="planning_new", methods={"POST"})
     */
    public function new(Request $request): Response
    {
        $requestedData = $request->request->all();
        // add New planningMenu
        $planning = new PlanningMenu();

        
        if (3 === count($requestedData)) {
            $idPeriod = 1;
        } elseif (15 === count($requestedData)) {
            $idPeriod = 2;
        } else {
            $idPeriod = 3;
        }
        $period = $this->periodRepo->find( $idPeriod);

        $planning->setType($period);
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
            if ('planning-name' !== $key) {
                $dish = null;

                if (0 !== $data) {
                    $dish = $this->dishRepo->find($data);   
                }
                $explodeData = explode('_', $key);

                $day = $this->dayRepo->find($dayArray[$explodeData[2]]);              
                $period = $this->periodRepo->find($periodArray[$explodeData[1]]); 
                $cat = $this->categoryRepo->find($catArray[$explodeData[3]]); 

                $planningDetail = new PlanningMenuDetail();
                $planningDetail->setWeekId($explodeData[0]);
                $planningDetail->setDish($dish);
                $planningDetail->setDay($day);
                $planningDetail->setPeriod($period);
                $planningDetail->setCategoryId($cat);
                $planningDetail->setPlanningMenu($planning);
                $entityManager->persist($planningDetail);
               
            }
        }
        $entityManager->flush();

        return $this->redirectToRoute('planning_list', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/planning/list", name="planning_list")
     */
    public function planning_list(PlanningMenuRepository $planningRepo): Response
    {
       $planning = $planningRepo->findAll(['user' => $this->getUser()]);

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
}
