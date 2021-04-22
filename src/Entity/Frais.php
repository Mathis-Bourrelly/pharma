<?php

namespace App\Entity;
use App\Repository\FraisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FraisRepository::class)
 */
class Frais
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="frais")
     */
    private $user;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\OneToMany(targetEntity=FraisKm::class, mappedBy="frais")
     */
    private $fraiskm;

    /**
     * @ORM\ManyToOne(targetEntity=NoteFraisMois::class, inversedBy="frais")
     */
    private $noteFraisMois;

    /**
     * @ORM\OneToMany(targetEntity=FraisGen::class, mappedBy="frais")
     */
    private $FraisGen;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $validation;

    /**
     * @ORM\ManyToOne(targetEntity=NoteFraisAnnuelle::class, inversedBy="frais")
     */
    private $noteFraisAnnuelle;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $valide;


    public function __construct()
    {
        $this->fraiskm = new ArrayCollection();
        $this->FraisGen = new ArrayCollection();
    }
    public function __toString()
    {
        return (string) $this->noteFraisMois.$this->noteFraisAnnuelle;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * @return Collection|FraisKm[]
     */
    public function getFraiskm(): Collection
    {
        return $this->fraiskm;
    }

    public function addFraiskm(FraisKm $fraiskm): self
    {
        if (!$this->fraiskm->contains($fraiskm)) {
            $this->fraiskm[] = $fraiskm;
            $fraiskm->setFrais($this);

        }

        return $this;
    }

    public function removeFraiskm(FraisKm $fraiskm): self
    {
        if ($this->fraiskm->removeElement($fraiskm)) {
            // set the owning side to null (unless already changed)
            if ($fraiskm->getFrais() === $this) {
                $fraiskm->setFrais(null);
            }
        }

        return $this;
    }

    public function getNoteFraisMois(): ?NoteFraisMois
    {
        return $this->noteFraisMois;
    }

    public function setNoteFraisMois(?NoteFraisMois $noteFraisMois): self
    {
        $this->noteFraisMois = $noteFraisMois;

        return $this;
    }

    /**
     * @return Collection|FraisGen[]
     */
    public function getFraisGen(): Collection
    {
        return $this->FraisGen;
    }

    public function addFraisGen(FraisGen $fraisGen): self
    {
        if (!$this->FraisGen->contains($fraisGen)) {
            $this->FraisGen[] = $fraisGen;
            $fraisGen->setFrais($this);
        }

        return $this;
    }

    public function removeFraisGen(FraisGen $fraisGen): self
    {
        if ($this->FraisGen->removeElement($fraisGen)) {
            // set the owning side to null (unless already changed)
            if ($fraisGen->getFrais() === $this) {
                $fraisGen->setFrais(null);
            }
        }

        return $this;
    }
    public function getTotal()
    {
        $total=0;
        foreach ($this->fraiskm as $km)
        {
            $total+=$km->getMontant();
        }
        foreach ($this->FraisGen as $gen)
        {
            $total+=$gen->getMontant();
        }
    return $total;
    }
    public function getKm()
    {
        $distance=0;
        foreach ($this->fraiskm as $km)
        {
            $distance+=$km->getDistance();
        }
        return $distance;
    }

    public function getValidation(): ?bool
    {
        return $this->validation;
    }

    public function setValidation(?bool $validation): self
    {
        $this->validation = $validation;

        return $this;
    }

    public function getNoteFraisAnnuelle(): ?NoteFraisAnnuelle
    {
        return $this->noteFraisAnnuelle;
    }

    public function setNoteFraisAnnuelle(?NoteFraisAnnuelle $noteFraisAnnuelle): self
    {
        $this->noteFraisAnnuelle = $noteFraisAnnuelle;

        return $this;
    }

    public function getValide(): ?bool
    {
        return $this->valide;
    }

    public function setValide(?bool $valide): self
    {
        $this->valide = $valide;

        return $this;
    }
}
