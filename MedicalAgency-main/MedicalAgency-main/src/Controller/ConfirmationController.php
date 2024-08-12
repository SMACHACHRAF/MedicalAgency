<?php

namespace App\Controller;

use App\Entity\PatientInformations;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/confirmation/patient")
 */
class ConfirmationController extends AbstractController
{

    /**
     *
     * @Route("/{id}", name="confirm", methods={"GET"})
     */
    public function decision (Request $request, PatientInformations $patientInformations)
    {
        return $this->render('patient_informations/descision.html.twig', [
            'patient_information' => $patientInformations,
        ]);
    }



    /**
     *
     * @Route("/patientConfirmed/{id}", name="patient_confirmed")
     */
    public function confirmed(Request $request, PatientInformations $patientInformation, \Swift_Mailer $mailer): Response
    {

        $patientInformation->setPatientConfirmed(1);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('homepage');



    }

    /**
     *
     * @Route("/patientNotConfirmed/{id}", name="patient_not_confirmed")
     */
    public function patientNotConfirmed(Request $request, PatientInformations $patientInformation, \Swift_Mailer $mailer): Response
    {

        $patientInformation->setPatientNotConfirmed(1);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('homepage');



    }


}
