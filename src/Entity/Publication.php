<?php

namespace App\Entity;

use App\Repository\PublicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PublicationRepository::class)]
class Publication
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Titre = null;

    #[ORM\Column(length: 255)]
    private ?string $Auteur = null;

    #[ORM\Column(length: 255)]
    private ?string $MotsCle = null;

    #[ORM\ManyToMany(targetEntity: Project::class)]
    private Collection $Project;

    #[ORM\ManyToMany(targetEntity: Chercheur::class, mappedBy: 'Publications')]
    private Collection $chercheurs;

    public function __construct()
    {
        $this->Project = new ArrayCollection();
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

    public function getAuteur(): ?string
    {
        return $this->Auteur;
    }

    public function setAuteur(string $Auteur): static
    {
        $this->Auteur = $Auteur;

        return $this;
    }

    public function getMotsCle(): ?string
    {
        return $this->MotsCle;
    }

    public function setMotsCle(string $MotsCle): static
    {
        $this->MotsCle = $MotsCle;

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProject(): Collection
    {
        return $this->Project;
    }

    public function addProject(Project $project): static
    {
        if (!$this->Project->contains($project)) {
            $this->Project->add($project);
        }

        return $this;
    }

    public function removeProject(Project $project): static
    {
        $this->Project->removeElement($project);

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
            $chercheur->addPublication($this);
        }

        return $this;
    }

    public function removeChercheur(Chercheur $chercheur): static
    {
        if ($this->chercheurs->removeElement($chercheur)) {
            $chercheur->removePublication($this);
        }

        return $this;
    }
}
