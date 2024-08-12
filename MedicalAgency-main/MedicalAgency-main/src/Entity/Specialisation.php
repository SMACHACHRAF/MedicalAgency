<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpecialisationRepository")
 */
class Specialisation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $spec;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PatientInformations", mappedBy="specialisation")
     */
    private $patient;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Users", mappedBy="specialisation")
     */
    private $Users;

    public function __construct()
    {
        $this->patient = new ArrayCollection();
        $this->Users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpec(): ?string
    {
        return $this->spec;
    }

    public function setSpec(string $spec): self
    {
        $this->spec = $spec;

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
            $patient->setSpecialisation($this);
        }

        return $this;
    }

    public function removePatient(PatientInformations $patient): self
    {
        if ($this->patient->contains($patient)) {
            $this->patient->removeElement($patient);
            // set the owning side to null (unless already changed)
            if ($patient->getSpecialisation() === $this) {
                $patient->setSpecialisation(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
return $this->spec;    }

    /**
     * @return Collection|Users[]
     */
    public function getUsers(): Collection
    {
        return $this->Users;
    }

    public function addUser(Users $user): self
    {
        if (!$this->Users->contains($user)) {
            $this->Users[] = $user;
            $user->setSpec($this);
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        if ($this->Users->contains($user)) {
            $this->Users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getSpec() === $this) {
                $user->setSpec(null);
            }
        }

        return $this;
    }

}
