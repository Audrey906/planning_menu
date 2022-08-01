<?php

namespace App\Entity;

use App\Repository\DishRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DishRepository::class)
 */
class Dish
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
    private $dish_name;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="dishes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="dishes")
     * @ORM\JoinColumn(nullable=false, onDelete="cascade")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=DishIngredient::class, mappedBy="dish", orphanRemoval=true)
     */
    private $dishIngredients;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=preparationTime::class, inversedBy="dishes")
     */
    private $time;

    public function __construct()
    {
        $this->dishIngredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDishName(): ?string
    {
        return $this->dish_name;
    }

    public function setDishName(string $dish_name): self
    {
        $this->dish_name = $dish_name;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

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
            $dishIngredient->setDish($this);
        }

        return $this;
    }

    public function removeDishIngredient(DishIngredient $dishIngredient): self
    {
        if ($this->dishIngredients->removeElement($dishIngredient)) {
            // set the owning side to null (unless already changed)
            if ($dishIngredient->getDish() === $this) {
                $dishIngredient->setDish(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getTime(): ?preparationTime
    {
        return $this->time;
    }

    public function setTime(?preparationTime $time): self
    {
        $this->time = $time;

        return $this;
    }
}
