<?php

namespace App\Entity;

use App\Repository\ShelfRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShelfRepository::class)]
class Shelf
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $number_category = null;

    #[ORM\OneToMany(mappedBy: 'shelf', targetEntity: category::class)]
    private Collection $category;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberCategory(): ?int
    {
        return $this->number_category;
    }

    public function setNumberCategory(int $number_category): self
    {
        $this->number_category = $number_category;
        return $this;
    }

    /**
     * @return Collection<int, category>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
            $category->setShelf($this);
        }

        return $this;
    }

    public function removeCategory(category $category): self
    {
        if ($this->category->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getShelf() === $this) {
                $category->setShelf(null);
            }
        }

        return $this;
    }

}
