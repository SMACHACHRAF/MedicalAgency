<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\MedicalCityRepository")
 */
class MedicalCity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Medical City is Required")
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TourismeRegion", mappedBy="medicalCity")
     */
    private $Region;

    public function __construct()
    {
        $this->Region = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection|TourismeRegion[]
     */
    public function getRegion(): Collection
    {
        return $this->Region;
    }

    public function addRegion(TourismeRegion $region): self
    {
        if (!$this->Region->contains($region)) {
            $this->Region[] = $region;
            $region->setMedicalCity($this);
        }

        return $this;
    }

    public function removeRegion(TourismeRegion $region): self
    {
        if ($this->Region->contains($region)) {
            $this->Region->removeElement($region);
            // set the owning side to null (unless already changed)
            if ($region->getMedicalCity() === $this) {
                $region->setMedicalCity(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
return $this->city;    }

}
