<?php

namespace App\Entity;

use App\Repository\NoteFraisAnnuelleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NoteFraisAnnuelleRepository::class)
 */
class NoteFraisAnnuelle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=NoteFraisMois::class, mappedBy="noteFraisAnnuelle")
     */
    private $NoteFraisMois;

    /**
     * @ORM\Column(type="string")
     */
    private $annee;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\OneToMany(targetEntity=Frais::class, mappedBy="noteFraisAnnuelle")
     */
    private $frais;

    public function __construct()
    {
        $this->noteFraisMois = new ArrayCollection();
        $this->frais = new ArrayCollection();
    }
    public function __toString()
    {
        return (string) $this->annee;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|NoteFraisMois[]
     */
    public function getNoteFraisMois(): Collection
    {
        return $this->NoteFraisMois;
    }

    public function addNoteFraisMoi(NoteFraisMois $noteFraisMoi): self
    {
        if (!$this->noteFraisMois->contains($noteFraisMoi)) {
            $this->noteFraisMois[] = $noteFraisMoi;
            $noteFraisMoi->setNoteFraisAnnuelle($this);
        }

        return $this;
    }

    public function removeNoteFraisMoi(NoteFraisMois $noteFraisMoi): self
    {
        if ($this->noteFraisMois->removeElement($noteFraisMoi)) {
            // set the owning side to null (unless already changed)
            if ($noteFraisMoi->getNoteFraisAnnuelle() === $this) {
                $noteFraisMoi->setNoteFraisAnnuelle(null);
            }
        }

        return $this;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(string $annee): self
    {
        $this->annee = $annee;

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
     * @return Collection|Frais[]
     */
    public function getFrais(): Collection
    {
        return $this->frais;
    }

    public function addFrai(Frais $frai): self
    {
        if (!$this->frais->contains($frai)) {
            $this->frais[] = $frai;
            $frai->setNoteFraisAnnuelle($this);
        }

        return $this;
    }

    public function removeFrai(Frais $frai): self
    {
        if ($this->frais->removeElement($frai)) {
            // set the owning side to null (unless already changed)
            if ($frai->getNoteFraisAnnuelle() === $this) {
                $frai->setNoteFraisAnnuelle(null);
            }
        }

        return $this;
    }
    public function total()
    {
        $total=0;
        foreach ($this->frais as $fr)
        {
            $total+=$fr->getMontant();
        }
        return $total;
    }
}
