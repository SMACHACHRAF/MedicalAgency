<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TourismeRegionRepository")
 */
class TourismeRegion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $Arrival_date;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $estimate_period;



    /**
     * @ORM\Column(type="boolean")
     */
    private $Guide;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Car;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PatientInformations", mappedBy="tourismeRegion")
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MedicalCity", inversedBy="Region",cascade={"persist"})
     */
    private $medicalCity;

    public function __construct()
    {
        $this->patient = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->Arrival_date;
    }

    public function setArrivalDate(\DateTimeInterface $Arrival_date): self
    {
        $this->Arrival_date = $Arrival_date;

        return $this;
    }

    public function getEstimatePeriod(): ?string
    {
        return $this->estimate_period;
    }

    public function setEstimatePeriod(string $estimate_period): self
    {
        $this->estimate_period = $estimate_period;

        return $this;
    }



    public function getGuide(): ?string
    {
        return $this->Guide;
    }

    public function setGuide(string $Guide): self
    {
        $this->Guide = $Guide;

        return $this;
    }

    public function getCar(): ?string
    {
        return $this->Car;
    }

    public function setCar(string $Car): self
    {
        $this->Car = $Car;

        return $this;
    }

    /**
     * @return Collection|PatientInformations[]
     */
    public function getPatient(): Collection
    {
        return $this->patient;
    }

    public function addPatient(PatientInformations $patient): self
    {
        if (!$this->patient->contains($patient)) {
            $this->patient[] = $patient;
            $patient->setTourismeRegion($this);
        }

        return $this;
    }

    public function removePatient(PatientInformations $patient): self
    {
        if ($this->patient->contains($patient)) {
            $this->patient->removeElement($patient);
            // set the owning side to null (unless already changed)
            if ($patient->getTourismeRegion() === $this) {
                $patient->setTourismeRegion(null);
            }
        }

        return $this;
    }

    public function getMedicalCity(): ?MedicalCity
    {
        return $this->medicalCity;
    }

    public function setMedicalCity(?MedicalCity $medicalCity): self
    {
        $this->medicalCity = $medicalCity;

        return $this;
    }




}
