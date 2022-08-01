<?php

namespace App\Entity;

use App\Repository\DishIngredientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DishIngredientRepository::class)
 */
class DishIngredient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredient::class, inversedBy="dishIngredients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ingredient;

    /**
     * @ORM\ManyToOne(targetEntity=Dish::class, inversedBy="dishIngredients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dish;

    /**
     * @ORM\ManyToOne(targetEntity=UnityIngredient::class, inversedBy="dishIngredients")
     */
    private $unity;

    /**
     * @ORM\Column(type="float")
     */
    private $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): self
    {
        $this->ingredient = $ingredient;

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

    public function getUnity(): ?UnityIngredient
    {
        return $this->unity;
    }

    public function setUnity(?UnityIngredient $unity): self
    {
        $this->unity = $unity;

        return $this;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
