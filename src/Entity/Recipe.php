<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column(length: 255)]
    private ?string $difficulty = null;

    #[ORM\Column]
    private ?int $peopleCount = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updateAt = null;

    #[ORM\ManyToOne(inversedBy: 'user')]
    private ?User $user = null;

    /**
     * @var Collection<int, ingredient>
     */
    #[ORM\OneToMany(targetEntity: ingredient::class, mappedBy: 'recipe')]
    private Collection $recipe;

    /**
     * @var Collection<int, comment>
     */
    #[ORM\OneToMany(targetEntity: comment::class, mappedBy: 'recipe')]
    private Collection $recipes;

    /**
     * @var Collection<int, like>
     */
    #[ORM\OneToMany(targetEntity: like::class, mappedBy: 'recipe')]
    private Collection $Recipe;

    public function __construct()
    {
        $this->recipe = new ArrayCollection();
        $this->recipes = new ArrayCollection();
        $this->Recipe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): static
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getPeopleCount(): ?int
    {
        return $this->peopleCount;
    }

    public function setPeopleCount(int $peopleCount): static
    {
        $this->peopleCount = $peopleCount;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeInterface $updateAt): static
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, ingredient>
     */
    public function getRecipe(): Collection
    {
        return $this->recipe;
    }

    public function addRecipe(ingredient $recipe): static
    {
        if (!$this->recipe->contains($recipe)) {
            $this->recipe->add($recipe);
            $recipe->setRecipe($this);
        }

        return $this;
    }

    public function removeRecipe(ingredient $recipe): static
    {
        if ($this->recipe->removeElement($recipe)) {
            // set the owning side to null (unless already changed)
            if ($recipe->getRecipe() === $this) {
                $recipe->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, comment>
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }
}
