<?php

namespace App\Entity;

use App\Repository\PeriodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PeriodRepository::class)
 */
class Period
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
    private $period_name;

    /**
     * @ORM\OneToMany(targetEntity=PlanningMenuDetail::class, mappedBy="period")
     */
    private $planningMenuDetails;

    public function __construct()
    {
        $this->planningMenuDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPeriodName(): ?string
    {
        return $this->period_name;
    }

    public function setPeriodName(string $period_name): self
    {
        $this->period_name = $period_name;

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
            $planningMenuDetail->setPeriod($this);
        }

        return $this;
    }

    public function removePlanningMenuDetail(PlanningMenuDetail $planningMenuDetail): self
    {
        if ($this->planningMenuDetails->removeElement($planningMenuDetail)) {
            // set the owning side to null (unless already changed)
            if ($planningMenuDetail->getPeriod() === $this) {
                $planningMenuDetail->setPeriod(null);
            }
        }

        return $this;
    }
}
