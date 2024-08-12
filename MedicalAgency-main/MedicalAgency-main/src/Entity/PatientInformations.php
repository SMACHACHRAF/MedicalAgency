<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber as AssertPhoneNumber;



/**
 * @ORM\Entity(repositoryClass="App\Repository\PatientInformationsRepository")
 */
class PatientInformations
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Name is Required")
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Your name cannot contain a number"
     * )

     */
    private $Name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Age;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $Sexe;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Specialisation", inversedBy="patient",cascade={"persist"})
     * @Assert\NotBlank(message="Specialisation is Required")
     */
    private $specialisation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TourismeRegion", inversedBy="patient",cascade={"persist"})
     */
    private $tourismeRegion;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Country is Required")
     */
    private $country;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Phone Number is Required")
     * @Assert\Type(
     *     type="integer",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @Assert\Length(
     *      min = 8,
     *      max = 30,
     *      minMessage = "Your Phone Number  must be at least {{ limit }} numbers long",
     *      maxMessage = "Your Phone Number cannot be longer than {{ limit }} numbers",
     * )

     */

    private $phone;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     * @Assert\NotBlank(message="Email is Required")

     */
    private $email;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Details is Required")
     */
    private $demande;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Housing", inversedBy="patient")
     */
    private $housing;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isApproved;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isRejected;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\MedicalFiles", inversedBy="patientInformations", cascade={"persist", "remove"})
     */
    private $patient_folder;

    /**
     * @ORM\Column(type="boolean")
     */
    private $emailComfired;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="patientInformations")
     */
    private $patient_doctor;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $report;

    /**
     * @ORM\Column(type="boolean")
     */
    private $informationsConfirmed;

    /**
     * @ORM\Column(type="boolean")
     */
    private $report_done;

    /**
     * @ORM\Column(type="boolean")
     */
    private $PatientConfirmed;

    /**
     * @ORM\Column(type="boolean")
     */
    private $PatientNotConfirmed;

    /**
     * @ORM\Column(type="boolean")
     */
    private $invoice_sent;


    /**
     * PatientInformations constructor.
     * @param $id
     */
    public function __construct()
    {
        $this->isApproved = 0;
        $this->isRejected = 0;
        $this->emailComfired = 0;
        $this->informationsConfirmed= 0;
        $this->report_done= 0;
        $this->PatientNotConfirmed = 0;
        $this->PatientConfirmed=0;
        $this->invoice_sent=0;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->Age;
    }

    public function setAge(int $Age): self
    {
        $this->Age = $Age;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->Sexe;
    }

    public function setSexe(string $Sexe): self
    {
        $this->Sexe = $Sexe;

        return $this;
    }

    public function getTourismRegion(): ?TourismRegion
    {
        return $this->tourismRegion;
    }

    public function setTourismRegion(?TourismRegion $tourismRegion): self
    {
        $this->tourismRegion = $tourismRegion;

        return $this;
    }


    public function getSpecialisation(): ?Specialisation
    {
        return $this->specialisation;
    }

    public function setSpecialisation(?Specialisation $specialisation): self
    {
        $this->specialisation = $specialisation;

        return $this;
    }

    public function getTourismeRegion(): ?TourismeRegion
    {
        return $this->tourismeRegion;
    }

    public function setTourismeRegion(?TourismeRegion $tourismeRegion): self
    {
        $this->tourismeRegion = $tourismeRegion;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getDemande(): ?string
    {
        return $this->demande;
    }

    public function setDemande(string $demande): self
    {
        $this->demande = $demande;

        return $this;
    }

    public function getHousing(): ?Housing
    {
        return $this->housing;
    }

    public function setHousing(?Housing $housing): self
    {
        $this->housing = $housing;

        return $this;
    }

    public function getIsApproved(): ?bool
    {
        return $this->isApproved;
    }

    public function setIsApproved(bool $isApproved): self
    {
        $this->isApproved = $isApproved;

        return $this;
    }

    public function getIsRejected(): ?bool
    {
        return $this->isRejected;
    }

    public function setIsRejected(bool $isRejected): self
    {
        $this->isRejected = $isRejected;

        return $this;
    }

    public function getPatientFolder(): ?MedicalFiles
    {
        return $this->patient_folder;
    }

    public function setPatientFolder(?MedicalFiles $patient_folder): self
    {
        $this->patient_folder = $patient_folder;

        return $this;
    }

    public function getEmailComfired(): ?bool
    {
        return $this->emailComfired;
    }

    public function setEmailComfired(bool $emailComfired): self
    {
        $this->emailComfired = $emailComfired;

        return $this;
    }

    public function getPatientDoctor(): ?Users
    {
        return $this->patient_doctor;
    }

    public function setPatientDoctor(?Users $patient_doctor): self
    {
        $this->patient_doctor = $patient_doctor;

        return $this;
    }

    public function getReport(): ?string
    {
        return $this->report;
    }

    public function setReport(?string $report): self
    {
        $this->report = $report;

        return $this;
    }

    public function getInformationsConfirmed(): ?bool
    {
        return $this->informationsConfirmed;
    }

    public function setInformationsConfirmed(bool $informationsConfirmed): self
    {
        $this->informationsConfirmed = $informationsConfirmed;

        return $this;
    }

    public function getReportDone(): ?bool
    {
        return $this->report_done;
    }

    public function setReportDone(bool $report_done): self
    {
        $this->report_done = $report_done;

        return $this;
    }

    public function getPatientConfirmed(): ?bool
    {
        return $this->PatientConfirmed;
    }

    public function setPatientConfirmed(bool $PatientConfirmed): self
    {
        $this->PatientConfirmed = $PatientConfirmed;

        return $this;
    }

    public function getPatientNotConfirmed(): ?bool
    {
        return $this->PatientNotConfirmed;
    }

    public function setPatientNotConfirmed(bool $PatientNotConfirmed): self
    {
        $this->PatientNotConfirmed = $PatientNotConfirmed;

        return $this;
    }

    public function getInvoiceSent(): ?bool
    {
        return $this->invoice_sent;
    }

    public function setInvoiceSent(bool $invoice_sent): self
    {
        $this->invoice_sent = $invoice_sent;

        return $this;
    }


}
