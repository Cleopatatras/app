<?php

namespace App\Entity;

use App\Repository\HabitatsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HabitatsRepository::class)]
class Habitats
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomHab = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $default_image = null;

    /**
     * @var Collection<int, Animaux>
     */
    #[ORM\OneToMany(targetEntity: Animaux::class, mappedBy: 'habitat', orphanRemoval: true)]
    private Collection $animauxes;

    /**
     * @var Collection<int, Images>
     */
    #[ORM\OneToMany(targetEntity: Images::class, mappedBy: 'habitat')]
    private Collection $service;

    public function __construct()
    {
        $this->animauxes = new ArrayCollection();
        $this->service = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomHab(): ?string
    {
        return $this->nomHab;
    }

    public function setNomHab(string $nomHab): static
    {
        $this->nomHab = $nomHab;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDefaultImage(): ?string
    {
        return $this->default_image;
    }

    public function setDefaultImage(string $default_image): static
    {
        $this->default_image = $default_image;

        return $this;
    }

    /**
     * @return Collection<int, Animaux>
     */
    public function getAnimauxes(): Collection
    {
        return $this->animauxes;
    }

    public function addAnimaux(Animaux $animaux): static
    {
        if (!$this->animauxes->contains($animaux)) {
            $this->animauxes->add($animaux);
            $animaux->setHabitat($this);
        }

        return $this;
    }

    public function removeAnimaux(Animaux $animaux): static
    {
        if ($this->animauxes->removeElement($animaux)) {
            // set the owning side to null (unless already changed)
            if ($animaux->getHabitat() === $this) {
                $animaux->setHabitat(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getService(): Collection
    {
        return $this->service;
    }

    public function addService(Images $service): static
    {
        if (!$this->service->contains($service)) {
            $this->service->add($service);
            $service->setHabitat($this);
        }

        return $this;
    }

    public function removeService(Images $service): static
    {
        if ($this->service->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getHabitat() === $this) {
                $service->setHabitat(null);
            }
        }

        return $this;
    }
}
