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
     * @ORM\Column(type="date")
     */
    private $annee;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    public function __construct()
    {
        $this->NoteFraisMois = new ArrayCollection();
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
        if (!$this->NoteFraisMois->contains($noteFraisMoi)) {
            $this->NoteFraisMois[] = $noteFraisMoi;
            $noteFraisMoi->setNoteFraisAnnuelle($this);
        }

        return $this;
    }

    public function removeNoteFraisMoi(NoteFraisMois $noteFraisMoi): self
    {
        if ($this->NoteFraisMois->removeElement($noteFraisMoi)) {
            // set the owning side to null (unless already changed)
            if ($noteFraisMoi->getNoteFraisAnnuelle() === $this) {
                $noteFraisMoi->setNoteFraisAnnuelle(null);
            }
        }

        return $this;
    }

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->annee;
    }

    public function setAnnee(\DateTimeInterface $annee): self
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
}
