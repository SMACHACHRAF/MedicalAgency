<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CurrentDiseaseRepository")
 */
class CurrentDisease
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DiseaseName;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DiseaseDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MedicalFiles", inversedBy="CurrentDisease" , cascade={"remove"})
     */
    private $medicalFiles;



    public function __construct()
    {
        $this->treatment = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiseaseName(): ?string
    {
        return $this->DiseaseName;
    }

    public function setDiseaseName(?string $DiseaseName): self
    {
        $this->DiseaseName = $DiseaseName;

        return $this;
    }

    public function getDiseaseDate(): ?\DateTimeInterface
    {
        return $this->DiseaseDate;
    }

    public function setDiseaseDate(?\DateTimeInterface $DiseaseDate): self
    {
        $this->DiseaseDate = $DiseaseDate;

        return $this;
    }

    public function getMedicalFiles(): ?MedicalFiles
    {
        return $this->medicalFiles;
    }

    public function setMedicalFiles(?MedicalFiles $medicalFiles): self
    {
        $this->medicalFiles = $medicalFiles;

        return $this;
    }

    /**
     * @return Collection|CurrentTreatments[]
     */
    public function getTreatment(): Collection
    {
        return $this->treatment;
    }

    public function addTreatment(CurrentTreatments $treatment): self
    {
        if (!$this->treatment->contains($treatment)) {
            $this->treatment[] = $treatment;
            $treatment->setCurrentDisease($this);
        }

        return $this;
    }

    public function removeTreatment(CurrentTreatments $treatment): self
    {
        if ($this->treatment->contains($treatment)) {
            $this->treatment->removeElement($treatment);
            // set the owning side to null (unless already changed)
            if ($treatment->getCurrentDisease() === $this) {
                $treatment->setCurrentDisease(null);
            }
        }

        return $this;
    }
}
