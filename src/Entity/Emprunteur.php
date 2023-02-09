<?php

namespace App\Entity;

use App\Repository\EmprunteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmprunteurRepository::class)]
class Emprunteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $number_book = null;

    #[ORM\OneToMany(mappedBy: 'emprunteur', targetEntity: book::class)]
    private Collection $book;

    public function __construct()
    {
        $this->book = new ArrayCollection();
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

    public function getNumberBook(): ?int
    {
        return $this->number_book;
    }

    public function setNumberBook(int $number_book): self
    {
        $this->number_book = $number_book;

        return $this;
    }

    /**
     * @return Collection<int, book>
     */
    public function getBook(): Collection
    {
        return $this->book;
    }

    public function addBook(book $book): self
    {
        if (!$this->book->contains($book)) {
            $this->book->add($book);
            $book->setEmprunteur($this);
        }

        return $this;
    }

    public function removeBook(book $book): self
    {
        if ($this->book->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getEmprunteur() === $this) {
                $book->setEmprunteur(null);
            }
        }

        return $this;
    }

}
