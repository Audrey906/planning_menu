<?php

namespace App\Manager;

use App\Entity\PlanningMenu;
use App\Repository\PeriodRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class PlanningManager
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var PeriodRepository
     */
    private $periodRepo;

    public function __construct(EntityManagerInterface $entityManager, PeriodRepository $periodRepo) {
        $this->entityManager = $entityManager;
        $this->periodRepo = $periodRepo;
    }

    public function persist(array $requestedData, UserInterface $user) : PlanningMenu
    {
        $planning = new PlanningMenu();
        
        $periodId = $this->getPeriodId(count($requestedData));

        $period = $this->periodRepo->find($periodId);

        $planning->setType($period);
        $planning->setUser($user);
        $planning->setPlanningName($requestedData['planning-name']);
        $planning->setPlanningCreatedDate(new \DateTime());
        $this->entityManager->persist($planning);

        return $planning;
    }

    public function getperiodId(int $countRequestedData) : int
    {
        // 3 = a month
        $idPeriod = 3;
        if (3 === $countRequestedData) {
            //  = a day
            $idPeriod = 1;
        } elseif (15 === $countRequestedData) {
            // 2 = a week
            $idPeriod = 2;
        } 

        return $idPeriod;
    }
}