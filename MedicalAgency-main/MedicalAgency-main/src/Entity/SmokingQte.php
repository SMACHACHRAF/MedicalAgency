<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SmokingQteRepository")
 */
class SmokingQte
{
    public function __toString()
    {
       return $this->qte;
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $qte;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MedicalFiles", mappedBy="qte_smoking")
     */
    private $medicalFiles;

    public function __construct()
    {
        $this->medicalFiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQte(): ?string
    {
        return $this->qte;
    }

    public function setQte(string $qte): self
    {
        $this->qte = $qte;

        return $this;
    }

    /**
     * @return Collection|MedicalFiles[]
     */
    public function getMedicalFiles(): Collection
    {
        return $this->medicalFiles;
    }

    public function addMedicalFile(MedicalFiles $medicalFile): self
    {
        if (!$this->medicalFiles->contains($medicalFile)) {
            $this->medicalFiles[] = $medicalFile;
            $medicalFile->setQteSmoking($this);
        }

        return $this;
    }

    public function removeMedicalFile(MedicalFiles $medicalFile): self
    {
        if ($this->medicalFiles->contains($medicalFile)) {
            $this->medicalFiles->removeElement($medicalFile);
            // set the owning side to null (unless already changed)
            if ($medicalFile->getQteSmoking() === $this) {
                $medicalFile->setQteSmoking(null);
            }
        }

        return $this;
    }
}
