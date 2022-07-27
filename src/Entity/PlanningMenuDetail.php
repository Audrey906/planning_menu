<?php

namespace App\Entity;

use App\Repository\PlanningMenuDetailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanningMenuDetailRepository::class)
 */
class PlanningMenuDetail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningMenu::class, inversedBy="planningMenuDetails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $planning_menu;

    /**
     * @ORM\Column(type="integer")
     */
    private $week_id;

    /**
     * @ORM\ManyToOne(targetEntity=Day::class, inversedBy="planningMenuDetails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $day;

    /**
     * @ORM\ManyToOne(targetEntity=Period::class, inversedBy="planningMenuDetails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $period;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=Dish::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $dish;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlanningMenu(): ?PlanningMenu
    {
        return $this->planning_menu;
    }

    public function setPlanningMenu(?PlanningMenu $planning_menu): self
    {
        $this->planning_menu = $planning_menu;

        return $this;
    }

    public function getWeekId(): ?int
    {
        return $this->week_id;
    }

    public function setWeekId(int $week_id): self
    {
        $this->week_id = $week_id;

        return $this;
    }

    public function getDay(): ?Day
    {
        return $this->day;
    }

    public function setDay(?Day $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getPeriod(): ?Period
    {
        return $this->period;
    }

    public function setPeriod(?Period $period): self
    {
        $this->period = $period;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategoryId(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDish(): ?Dish
    {
        return $this->dish;
    }

    public function setDish(?Dish $dish): self
    {
        $this->dish = $dish;

        return $this;
    }
}
