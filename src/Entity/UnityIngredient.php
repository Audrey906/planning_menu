<?php

namespace App\Entity;

use App\Repository\UnityIngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UnityIngredientRepository::class)
 */
class UnityIngredient
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=DishIngredient::class, mappedBy="unity")
     */
    private $dishIngredients;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->dishIngredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|DishIngredient[]
     */
    public function getDishIngredients(): Collection
    {
        return $this->dishIngredients;
    }

    public function addDishIngredient(DishIngredient $dishIngredient): self
    {
        if (!$this->dishIngredients->contains($dishIngredient)) {
            $this->dishIngredients[] = $dishIngredient;
            $dishIngredient->setUnity($this);
        }

        return $this;
    }

    public function removeDishIngredient(DishIngredient $dishIngredient): self
    {
        if ($this->dishIngredients->removeElement($dishIngredient)) {
            // set the owning side to null (unless already changed)
            if ($dishIngredient->getUnity() === $this) {
                $dishIngredient->setUnity(null);
            }
        }

        return $this;
    }
}
