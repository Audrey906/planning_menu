<?php

namespace App\Entity;

use App\Repository\DayRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DayRepository::class)
 */
class Day
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $day_name;

    /**
     * @ORM\OneToMany(targetEntity=PlanningMenuDetail::class, mappedBy="day")
     */
    private $planningMenuDetails;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $day_small_name;

    public function __construct()
    {
        $this->planningMenuDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDayName(): ?string
    {
        return $this->day_name;
    }

    public function setDayName(string $day_name): self
    {
        $this->day_name = $day_name;

        return $this;
    }

    /**
     * @return Collection|PlanningMenuDetail[]
     */
    public function getPlanningMenuDetails(): Collection
    {
        return $this->planningMenuDetails;
    }

    public function addPlanningMenuDetail(PlanningMenuDetail $planningMenuDetail): self
    {
        if (!$this->planningMenuDetails->contains($planningMenuDetail)) {
            $this->planningMenuDetails[] = $planningMenuDetail;
            $planningMenuDetail->setDay($this);
        }

        return $this;
    }

    public function removePlanningMenuDetail(PlanningMenuDetail $planningMenuDetail): self
    {
        if ($this->planningMenuDetails->removeElement($planningMenuDetail)) {
            // set the owning side to null (unless already changed)
            if ($planningMenuDetail->getDay() === $this) {
                $planningMenuDetail->setDay(null);
            }
        }

        return $this;
    }

    public function getDaySmallName(): ?string
    {
        return $this->day_small_name;
    }

    public function setDaySmallName(?string $day_small_name): self
    {
        $this->day_small_name = $day_small_name;

        return $this;
    }
}
