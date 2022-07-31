<?php

namespace App\Controller;

use App\Entity\PlanningMenuDetail;
use App\Repository\DayRepository;
use App\Repository\DishRepository;
use App\Repository\PlanningMenuDetailRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlanningDetailController extends AbstractController
{
    /**
     * @Route("/planning/detail/update/dish", name="planning_detail_update_dish",methods={"POST"})
     */
    public function updateDish(Request $request, PlanningMenuDetailRepository $planningDetailRepo, DishRepository $dishRepo, DayRepository $dayRepo): Response
    {
        $plannindDetailId = $request->request->get('idPlanning');
        $planningDetail = $planningDetailRepo->find($plannindDetailId);

        $newDishId = $request->request->get('newDish');
        $dish = $dishRepo->find($newDishId);

        // update planningDetail
        $planningDetail->setDish($dish);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($planningDetail);
        $entityManager->flush();

        // info for render
        $planning = $planningDetail->getPlanningMenu();
        $detail = $planning->getPlanningMenuDetails()->getValues();
        $dishes = $dishRepo->findBy(['user' => $this->getUser()], ['dish_name' => 'ASC']);
        $days = $dayRepo->findAll();

        return $this->render('planning/show.html.twig', [
            'planning' => $planning,
            'detail' => $detail,
            'dishes' => $dishes,
            'days' => $days,
        ]);
    }

    /**
     * @Route("/planning/detail/update/visibilty/{id}", name="planning_detail_update_visibility",methods={"POST"})
     */
    public function updateVisibility(PlanningMenuDetail $planningDetail, Request $request, PlanningMenuDetailRepository $planningDetailRepo, DishRepository $dishRepo, DayRepository $dayRepo): Response
    {
        $visibility = false;
        if (!$planningDetail->getDone()) {
            $visibility = true;
       }

        // update planningDetail
        $planningDetail->setDone($visibility);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($planningDetail);
        $entityManager->flush();

        // info for render
        $planning = $planningDetail->getPlanningMenu();
        $detail = $planning->getPlanningMenuDetails()->getValues();
        $dishes = $dishRepo->findBy(['user' => $this->getUser()]);
        $days = $dayRepo->findAll();

        return $this->render('planning/show.html.twig', [
            'planning' => $planning,
            'detail' => $detail,
            'dishes' => $dishes,
            'days' => $days,
        ]);
    }
}
