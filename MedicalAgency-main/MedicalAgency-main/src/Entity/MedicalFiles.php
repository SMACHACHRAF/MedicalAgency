<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich  ;


/**
 * @ORM\Entity(repositoryClass="App\Repository\MedicalFilesRepository")
 * @Vich\Uploadable

 */
class MedicalFiles
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Vich\UploadableField(mapping="medicalfiles", fileNameProperty="medical_file_name")
     * @var File
     */
    private $Medical_File;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $medical_file_name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $uploadAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $weight;

    /**
     * @ORM\Column(type="integer")
     */
    private $size;

    /**
     * @ORM\Column(type="boolean")
     */
    private $IsSmoking;

    /**
     * @ORM\Column(type="boolean")
     */
    private $IsAlcohloic;

    /**
     * @ORM\Column(type="text")
     */
    private $health_info;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\PatientInformations", mappedBy="patient_folder", cascade={"persist", "remove"})
     */
    private $patientInformations;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SmokingQte", inversedBy="medicalFiles")
     */
    private $qte_smoking;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AlcoholQte", inversedBy="medicalFiles")
     */
    private $qtealcohol;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_approved;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_rejected;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CurrentDisease", mappedBy="medicalFiles", cascade={"persist"})
     */
    private $CurrentDisease;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PreviousMedicalOperation", mappedBy="medicalFiles", cascade={"persist"})
     */
    private $PrevOper;

    /**
     * @ORM\Column(type="boolean")
     */
    private $emailConfirmed;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CurrentTreatments", mappedBy="medicalFiles", cascade={"persist"} )
     */
    private $treatments;



    /**
     * MedicalFiles constructor.
     */
    public function __construct()
    {
        $this->is_rejected=0;
        $this->is_approved=0;
        $this->CurrentDisease = new ArrayCollection();
        $this->CurrentTreatments = new ArrayCollection();
        $this->PrevOper = new ArrayCollection();
        $this->emailConfirmed=0 ;
        $this->treatments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMedicalFile()
    {
        return $this->Medical_File;
    }

    public function setMedicalFile(File $Medical_File): self
    {

        if ($Medical_File) {
            $this->uploadAt = new \DateTime('now');
        }
        $this->Medical_File = $Medical_File;

        return $this;
    }

    public function getMedicalFileName(): ?string
    {
        return $this->medical_file_name;
    }

    public function setMedicalFileName(string $medical_file_name): self
    {
        $this->medical_file_name = $medical_file_name;

        return $this;
    }

    public function getUploadAt(): ?\DateTimeInterface
    {
        return $this->uploadAt;
    }

    public function setUploadAt(\DateTimeInterface $uploadAt): self
    {
        $this->uploadAt = $uploadAt;

        return $this;
    }

    public function getPatientInformations(): ?PatientInformations
    {
        return $this->patientInformations;
    }

    public function setPatientInformations(?PatientInformations $patientInformations): self
    {
        $this->patientInformations = $patientInformations;

        // set (or unset) the owning side of the relation if necessary
        $newPatient_folder = null === $patientInformations ? null : $this;
        if ($patientInformations->getPatientFolder() !== $newPatient_folder) {
            $patientInformations->setPatientFolder($newPatient_folder);
        }

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getIsSmoking(): ?bool
    {
        return $this->IsSmoking;
    }

    public function setIsSmoking(bool $IsSmoking): self
    {
        $this->IsSmoking = $IsSmoking;

        return $this;
    }

    public function getIsAlcohloic(): ?bool
    {
        return $this->IsAlcohloic;
    }

    public function setIsAlcohloic(bool $IsAlcohloic): self
    {
        $this->IsAlcohloic = $IsAlcohloic;

        return $this;
    }

    public function getHealthInfo(): ?string
    {
        return $this->health_info;
    }

    public function setHealthInfo(string $health_info): self
    {
        $this->health_info = $health_info;

        return $this;
    }

    public function getQteSmoking(): ?SmokingQte
    {
        return $this->qte_smoking;
    }

    public function setQteSmoking(?SmokingQte $qte_smoking): self
    {
        $this->qte_smoking = $qte_smoking;

        return $this;
    }

    public function getQtealcohol(): ?AlcoholQte
    {
        return $this->qtealcohol;
    }

    public function setQtealcohol(?AlcoholQte $qtealcohol): self
    {
        $this->qtealcohol = $qtealcohol;

        return $this;
    }

    public function getIsApproved(): ?bool
    {
        return $this->is_approved;
    }

    public function setIsApproved(bool $is_approved): self
    {
        $this->is_approved = $is_approved;

        return $this;
    }

    public function getIsRejected(): ?bool
    {
        return $this->is_rejected;
    }

    public function setIsRejected(bool $is_rejected): self
    {
        $this->is_rejected = $is_rejected;

        return $this;
    }

    /**
     * @return Collection|CurrentDisease[]
     */
    public function getCurrentDisease(): Collection
    {
        return $this->CurrentDisease;
    }

    public function addCurrentDisease(CurrentDisease $currentDisease): self
    {
        if (!$this->CurrentDisease->contains($currentDisease)) {
            $this->CurrentDisease[] = $currentDisease;
            $currentDisease->setMedicalFiles($this);
        }

        return $this;
    }

    public function removeCurrentDisease(CurrentDisease $currentDisease): self
    {
        if ($this->CurrentDisease->contains($currentDisease)) {
            $this->CurrentDisease->removeElement($currentDisease);
            // set the owning side to null (unless already changed)
            if ($currentDisease->getMedicalFiles() === $this) {
                $currentDisease->setMedicalFiles(null);
            }
        }

        return $this;
    }



    /**
     * @return Collection|PreviousMedicalOperation[]
     */
    public function getPrevOper(): Collection
    {
        return $this->PrevOper;
    }

    public function addPrevOper(PreviousMedicalOperation $prevOper): self
    {
        if (!$this->PrevOper->contains($prevOper)) {
            $this->PrevOper[] = $prevOper;
            $prevOper->setMedicalFiles($this);
        }

        return $this;
    }

    public function removePrevOper(PreviousMedicalOperation $prevOper): self
    {
        if ($this->PrevOper->contains($prevOper)) {
            $this->PrevOper->removeElement($prevOper);
            // set the owning side to null (unless already changed)
            if ($prevOper->getMedicalFiles() === $this) {
                $prevOper->setMedicalFiles(null);
            }
        }

        return $this;
    }

    public function getEmailConfirmed(): ?bool
    {
        return $this->emailConfirmed;
    }

    public function setEmailConfirmed(bool $emailConfirmed): self
    {
        $this->emailConfirmed = $emailConfirmed;

        return $this;
    }

    /**
     * @return Collection|CurrentTreatments[]
     */
    public function getTreatments(): Collection
    {
        return $this->treatments;
    }

    public function addTreatment(CurrentTreatments $treatment): self
    {
        if (!$this->treatments->contains($treatment)) {
            $this->treatments[] = $treatment;
            $treatment->setMedicalFiles($this);
        }

        return $this;
    }

    public function removeTreatment(CurrentTreatments $treatment): self
    {
        if ($this->treatments->contains($treatment)) {
            $this->treatments->removeElement($treatment);
            // set the owning side to null (unless already changed)
            if ($treatment->getMedicalFiles() === $this) {
                $treatment->setMedicalFiles(null);
            }
        }

        return $this;
    }







}
