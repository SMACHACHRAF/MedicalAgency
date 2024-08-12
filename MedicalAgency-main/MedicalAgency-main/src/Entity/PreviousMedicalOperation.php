<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PreviousMedicalOperationRepository")
 */
class PreviousMedicalOperation
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
    private $MedicalOperationType;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $OperationDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MedicalFiles", inversedBy="PrevOper" , cascade={"remove"})
     */
    private $medicalFiles;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMedicalOperationType(): ?string
    {
        return $this->MedicalOperationType;
    }

    public function setMedicalOperationType(?string $MedicalOperationType): self
    {
        $this->MedicalOperationType = $MedicalOperationType;

        return $this;
    }

    public function getOperationDate(): ?\DateTimeInterface
    {
        return $this->OperationDate;
    }

    public function setOperationDate(?\DateTimeInterface $OperationDate): self
    {
        $this->OperationDate = $OperationDate;

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
