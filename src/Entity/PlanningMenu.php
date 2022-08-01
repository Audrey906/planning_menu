<?php

namespace App\Entity;

use App\Repository\PlanningMenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanningMenuRepository::class)
 */
class PlanningMenu
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
    private $planning_name;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="planningMenus")
     * @ORM\JoinColumn(nullable=false, onDelete="cascade")
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $planning_created_date;

    /**
     * @ORM\OneToMany(targetEntity=PlanningMenuDetail::class, mappedBy="planning_menu", orphanRemoval=true)
     */
    private $planningMenuDetails;

    /**
     * @ORM\ManyToOne(targetEntity=Period::class, inversedBy="planningMenus")
     */
    private $type;

    public function __construct()
    {
        $this->planningMenuDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlanningName(): ?string
    {
        return $this->planning_name;
    }

    public function setPlanningName(string $planning_name): self
    {
        $this->planning_name = $planning_name;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPlanningCreatedDate(): ?\DateTimeInterface
    {
        return $this->planning_created_date;
    }

    public function setPlanningCreatedDate(\DateTimeInterface $planning_created_date): self
    {
        $this->planning_created_date = $planning_created_date;

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
            $planningMenuDetail->setPlanningMenu($this);
        }

        return $this;
    }

    public function removePlanningMenuDetail(PlanningMenuDetail $planningMenuDetail): self
    {
        if ($this->planningMenuDetails->removeElement($planningMenuDetail)) {
            // set the owning side to null (unless already changed)
            if ($planningMenuDetail->getPlanningMenu() === $this) {
                $planningMenuDetail->setPlanningMenu(null);
            }
        }

        return $this;
    }

    public function getType(): ?Period
    {
        return $this->type;
    }

    public function setType(?Period $type): self
    {
        $this->type = $type;

        return $this;
    }
}
