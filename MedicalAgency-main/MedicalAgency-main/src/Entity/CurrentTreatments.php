<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CurrentTreatmentsRepository")
 */
class CurrentTreatments
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
    private $TreatmentName;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MedicalFiles", inversedBy="treatments")
     */
    private $medicalFiles;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTreatmentName(): ?string
    {
        return $this->TreatmentName;
    }

    public function setTreatmentName(?string $TreatmentName): self
    {
        $this->TreatmentName = $TreatmentName;

        return $this;
    }

    public function getCurrentDisease(): ?CurrentDisease
    {
        return $this->currentDisease;
    }

    public function setCurrentDisease(?CurrentDisease $currentDisease): self
    {
        $this->currentDisease = $currentDisease;

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


}
