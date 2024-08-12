<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\HousingRepository")
 */
class Housing
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Housing is requird")
     */
    private $Place;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PatientInformations", mappedBy="housing")
     */
    private $patient;



    public function __construct()
    {
        $this->patient = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlace(): ?string
    {
        return $this->Place;
    }

    public function setPlace(string $Place): self
    {
        $this->Place = $Place;

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
            $patient->setHousing($this);
        }

        return $this;
    }

    public function removePatient(PatientInformations $patient): self
    {
        if ($this->patient->contains($patient)) {
            $this->patient->removeElement($patient);
            // set the owning side to null (unless already changed)
            if ($patient->getHousing() === $this) {
                $patient->setHousing(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
return $this->Place;    }


}
