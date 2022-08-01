<?php

namespace App\Manager;

use App\Entity\PlanningMenu;
use App\Repository\DayRepository;
use App\Entity\PlanningMenuDetail;
use App\Repository\PeriodRepository;
use App\Repository\CategoryRepository;
use App\Repository\DishRepository;
use Doctrine\ORM\EntityManagerInterface;

class PlanningDetailManager
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepo;

    /**
     * @var DayRepository
     */
    private $dayRepo;

    /**
     * @var PeriodRepository
     */
    private $periodRepo;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var DishRepository
     */
    private $dishRepo;


    public function __construct(EntityManagerInterface $entityManager, DayRepository $dayRepo, PeriodRepository $periodRepo, CategoryRepository $categoryRepo, DishRepository $dishRepo) {
        $this->entityManager = $entityManager;
        $this->dayRepo = $dayRepo;
        $this->periodRepo = $periodRepo;
        $this->categoryRepo = $categoryRepo;
        $this->dishRepo = $dishRepo;
    }
    
    public function persist(PlanningMenu $planning, array $requestedData): void
    {
        $dayArray = $this->getDayArray();
        $periodArray = $this->getPeriodArray();
        $catArray = $this->getCatArray();

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
                $this-> entityManager->persist($planningDetail);
            }
        }
    }

    private function getDayArray(): array
    {
        $days = $this->dayRepo->findAll();
        foreach ($days as $k => $d) {
            $dayArray[$d->getId()] = $d;
        }

        return $dayArray;
    }

    private function getPeriodArray(): array
    {
        $periods = $this->periodRepo->findAll();
        foreach ($periods as $k => $p) {
            $periodArray[$p->getId()] = $p;
        }

        return $periodArray;
    }

    private function getCatArray(): array
    {
        $cats = $this->categoryRepo->findAll();
        foreach ($cats as $k => $c) {
            $catArray[$c->getId()] = $c;
        }

        return $catArray;
    }
}