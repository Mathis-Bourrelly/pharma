<?php

namespace App\Entity;

use App\Repository\NoteFraisMoisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NoteFraisMoisRepository::class)
 */
class NoteFraisMois
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mois;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\OneToMany(targetEntity=Frais::class, mappedBy="noteFraisMois")
     */
    private $frais;

    /**
     * @ORM\ManyToOne(targetEntity=NoteFraisAnnuelle::class, inversedBy="NoteFraisMois")
     */
    private $noteFraisAnnuelle;

    public function __construct()
    {
        $this->frais = new ArrayCollection();
    }
    public function __toString(): ?string
    {
        return (string) $this->mois;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMois(): ?string
    {
        return $this->mois;
    }

    public function setMois(string $mois): self
    {
        $this->mois = $mois;

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
            $frai->setNoteFraisMois($this);
        }

        return $this;
    }

    public function removeFrai(Frais $frai): self
    {
        if ($this->frais->removeElement($frai)) {
            // set the owning side to null (unless already changed)
            if ($frai->getNoteFraisMois() === $this) {
                $frai->setNoteFraisMois(null);
            }
        }

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
    public function total(): ?float
    {
        $total=0;
        foreach ($this->frais as $fr)
        {
            $total+=$fr->getMontant();
        }
        return $total;
    }
}
