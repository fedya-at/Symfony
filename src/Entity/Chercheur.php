<?php

namespace App\Entity;

use App\Repository\ChercheurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChercheurRepository::class)]
class Chercheur 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $Email = null;

    #[ORM\Column(length: 255)]
    private ?string $Password = null;

    #[ORM\Column(length: 255)]
    private ?string $Role = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Birth = null;

    #[ORM\ManyToMany(targetEntity: Project::class, inversedBy: 'chercheurs')]
    private Collection $projects;

    #[ORM\ManyToMany(targetEntity: Publication::class, inversedBy: 'chercheurs')]
    private Collection $Publications;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
        $this->Publications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): static
    {
        $this->Password = $Password;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->Role;
    }

    public function setRole(string $Role): static
    {
        $this->Role = $Role;

        return $this;
    }

    public function getBirth(): ?\DateTimeInterface
    {
        return $this->Birth;
    }

    public function setBirth(\DateTimeInterface $Birth): static
    {
        $this->Birth = $Birth;

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): static
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
        }

        return $this;
    }

    public function removeProject(Project $project): static
    {
        $this->projects->removeElement($project);

        return $this;
    }

    /**
     * @return Collection<int, Publication>
     */
    public function getPublications(): Collection
    {
        return $this->Publications;
    }

    public function addPublication(Publication $publication): static
    {
        if (!$this->Publications->contains($publication)) {
            $this->Publications->add($publication);
        }

        return $this;
    }

    public function removePublication(Publication $publication): static
    {
        $this->Publications->removeElement($publication);

        return $this;
    }
}
