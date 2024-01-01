<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(length: 255)]
    private ?string $Avancement = null;

    #[ORM\ManyToMany(targetEntity: Chercheur::class, mappedBy: 'projects')]
    private Collection $chercheurs;

    public function __construct()
    {
        $this->chercheurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): static
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getAvancement(): ?string
    {
        return $this->Avancement;
    }

    public function setAvancement(string $Avancement): static
    {
        $this->Avancement = $Avancement;

        return $this;
    }

    /**
     * @return Collection<int, Chercheur>
     */
    public function getChercheurs(): Collection
    {
        return $this->chercheurs;
    }

    public function addChercheur(Chercheur $chercheur): static
    {
        if (!$this->chercheurs->contains($chercheur)) {
            $this->chercheurs->add($chercheur);
            $chercheur->addProject($this);
        }

        return $this;
    }

    public function removeChercheur(Chercheur $chercheur): static
    {
        if ($this->chercheurs->removeElement($chercheur)) {
            $chercheur->removeProject($this);
        }

        return $this;
    }
}
