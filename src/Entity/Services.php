<?php

namespace App\Entity;

use App\Repository\ServicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicesRepository::class)]
class Services
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $default_image = null;

    /**
     * @var Collection<int, Images>
     */
    #[ORM\OneToMany(targetEntity: Images::class, mappedBy: 'service')]
    private Collection $link_image;

    public function __construct()
    {
        $this->link_image = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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
     * @return Collection<int, Images>
     */
    public function getLinkImage(): Collection
    {
        return $this->link_image;
    }

    public function addLinkImage(Images $linkImage): static
    {
        if (!$this->link_image->contains($linkImage)) {
            $this->link_image->add($linkImage);
            $linkImage->setService($this);
        }

        return $this;
    }

    public function removeLinkImage(Images $linkImage): static
    {
        if ($this->link_image->removeElement($linkImage)) {
            // set the owning side to null (unless already changed)
            if ($linkImage->getService() === $this) {
                $linkImage->setService(null);
            }
        }

        return $this;
    }
}
