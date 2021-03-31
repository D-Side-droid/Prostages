<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
	 * @Assert\NotBlank
     * @Assert\Length(
     *      min = 5,
     *      max = 255,
     *      minMessage = "Le nom de l'entreprise doit faire au minimum {{ limit }} caractères",
     *      maxMessage = "Le nom de l'entreprise doit faire au maximum {{ limit }} caractères"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
	 * @Assert\Regex( pattern="#rue|avenue|boulevard|impasse|allée|place|route|voie|mail#",message="type de voie invalide")
     * @Assert\Regex( pattern="# [0-9]{5} #",message="code postal invalide invalide")
     * @Assert\Regex( pattern="#[0-9]{3,} #",message="numéro de rue invalide")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
	 * @Assert\NotBlank
	 * 
	 */
    private $milieu;


    /**
     * @ORM\OneToMany(targetEntity=Stage::class, mappedBy="entreprises")
     */
    private $stages;

    public function __construct()
    {
        $this->stages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getMilieu(): ?string
    {
        return $this->milieu;
    }

    public function setMilieu(string $milieu): self
    {
        $this->milieu = $milieu;

        return $this;
    }

    /**
     * @return Collection|Stage[]
     */
    public function getStages(): Collection
    {
        return $this->stages;
    }

    public function addStage(Stage $stage): self
    {
        if (!$this->stages->contains($stage)) {
            $this->stages[] = $stage;
            $stage->setEntreprises($this);
        }

        return $this;
    }

    public function removeStage(Stage $stage): self
    {
        if ($this->stages->removeElement($stage)) {
            // set the owning side to null (unless already changed)
            if ($stage->getEntreprises() === $this) {
                $stage->setEntreprises(null);
            }
        }

        return $this;
    }
}
