<?php

namespace App\Controller;

use App\Entity\Housing;
use App\Entity\PatientInformations;
use App\Entity\TourismeRegion;
use App\Form\HousingType;
use App\Form\PatientInfo2Type;
use App\Form\RegiontourismType;
use App\Repository\PatientInformationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatientInfoController extends AbstractController
{
    /**
     * @Route("/patient/info/{email}/{id}", name="patient_info")
     */
    public function index(Request $request,String $email,int $id,PatientInformationsRepository $repository)
    {

        $patient = $repository->findOneBy(['email' => $email,'id'=>$id]);


        $form = $this->createForm(PatientInfo2Type::class, $patient);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $patient->setEmailComfired(true);
            $patient->setInformationsConfirmed(true);
            $this->getDoctrine()->getManager()->persist($patient);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('form complete', 'OK');
            return $this->redirectToRoute('homepage');


        }


        return $this->render('patient_info/index.html.twig', [
            'PatientInfo' => $form->createView(),
        ]);

    }
}
