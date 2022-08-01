<?php

namespace App\Entity;

use App\Repository\DishRepository;
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
}
