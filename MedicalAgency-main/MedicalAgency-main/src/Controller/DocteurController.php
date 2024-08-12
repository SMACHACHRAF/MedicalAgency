<?php

namespace App\Controller;

use App\Entity\PatientInformations;
use App\Repository\MedicalFilesRepository;
use App\Repository\PatientInformationsRepository;
use App\Repository\SpecialisationRepository;
use App\Repository\UsersRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use PhpParser\Node\Scalar\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;


/**
 * @Route("/doctor")
 */
class DocteurController extends AbstractController
{
    /**
     * @Route("/pending_reports", name="pending_reports")
     */
    public function index(PatientInformationsRepository $patientInformationsRepository)
    {
        $docteur = $this->getUser();
        $docteur->getSpec();
        //mordha 7asb specialité mta3 tbib
        //dump('all patient by speciality');
        //dump($patientInformationsRepository->findBy(['specialisation' => $docteur->getSpec()]));
        //dump('current patients');
        //$patientInformationsRepository->findBy(['patient_doctor' => $docteur->getId()]);
        //dd("done");
        return $this->render('docteur/index.html.twig', [
            'patients' =>$patientInformationsRepository->findBy([
                    'patient_doctor' => $docteur->getId(),
                    'report_done' => false
            ]),
            'username' =>$docteur->getUsername(),
            'email' =>$docteur->getEmail(),



        ]);
    }


    /**
     *
     * @Route("/statdocteur", name="stat_doc", methods={"GET"})
     */
    function stat(Request $request, PatientInformationsRepository $patientInformationsRepository, MedicalFilesRepository $repository, SpecialisationRepository $spec, UsersRepository $usersRepository)
    {
        $docteur = $this->getUser();
        $all = $patientInformationsRepository->findBy( ['patient_doctor' => $docteur->getId()] );
        $history = $patientInformationsRepository->findBy( ['patient_doctor' => $docteur->getId(), 'report_done' => true] );
        $pending = $patientInformationsRepository->findBy( ['patient_doctor' => $docteur->getId(), 'report_done' => false] );

       // dump(count($all));
        //dump(count($history));
        //dump(count($pending));
        //dd();
        $test = count($all);
        if ($test == 0) {
            $test = 1;
        }
        return $this->render('docteur/stat.html.twig', [
            'username' => $docteur->getUsername(),
            'email' => $docteur->getEmail(),
            'history' => count($history) * 100 / $test,
            'pending' => count($pending) * 100 /$test,
            'all' => count($all),

        ]);
    }


    /**
     * @Route("/history", name="history_reports")
     */
    public function history(PatientInformationsRepository $patientInformationsRepository)
    {
        $docteur = $this->getUser();
        $docteur->getSpec();
        //mordha 7asb specialité mta3 tbib
        //dump('all patient by speciality');
        //dump($patientInformationsRepository->findBy(['specialisation' => $docteur->getSpec()]));
        //dump('current patients');
        //$patientInformationsRepository->findBy(['patient_doctor' => $docteur->getId()]);
        //dd("done");
        return $this->render('docteur/history.html.twig', [
            'patients' =>$patientInformationsRepository->findBy([
                'patient_doctor' => $docteur->getId(),
                'report_done' => true
            ]),            'username' =>$docteur->getUsername(),
            'email' =>$docteur->getEmail()



        ]);
    }

    /**
     * @Route("/rapport/{id}", name="patient_rapport", methods={"GET","POST"})
     */
    public function doctorSelect(Request $request, int $id, PatientInformationsRepository $patientInformationsRepository, UsersRepository $usersRepository): Response
    {
        $docteur = $this->getUser();
        $Patient = $patientInformationsRepository->findOneBy(['id' => $id]);
        $form = $this->createFormBuilder($Patient)
            ->add('report', CKEditorType::class)
            ->add('save', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $this->getDoctrine()->getManager()->persist($Patient);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pending_reports');
        }

        return $this->render('docteur/writereport.html.twig', [
            'form' => $form->createView(),
            'username' => $docteur->getUsername(),
            'email' => $docteur->getEmail(),
            'patient' =>$patientInformationsRepository->findOneBy([
             'patient_doctor' => $docteur->getId(),
             'id' => $Patient->getId(),
            ]),
        ]);
    }


    /**
     * @Route("/downpdf/{id}", name="down_pdf", methods={"GET"})
     */
    public function downpdf(Request $request, PatientInformations $patientInformation): Response
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $dompdf->loadHtml($patientInformation->getReport());
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("(".$patientInformation->getId().")".$patientInformation->getName(), [
            "Attachment" => true
        ]);



    }



    /**
     * @Route("/show/{id}", name="patient", methods={"GET"})
     */
    public function showinformations(Request $request, PatientInformations $patientInformation): Response
    {
        // Configure Dompdf according to your needs
        return $this->render('docteur/show.html.twig', [
            'patient_information' => $patientInformation,

        ]);
    }

    /**
     * @Route("/folder/{id}", name="patient", methods={"GET"})
     */
    public function folderinformations(Request $request, PatientInformations $patientInformation): Response
    {
            $docteur = $this->getUser();
        return $this->render('docteur/folder.html.twig', [
            'medical_file' => $patientInformation->getPatientFolder(),
            'username' => $docteur->getUsername(),
            'email' => $docteur->getEmail(),
            'patient' => $patientInformation,

        ]);
    }


    /**
     * @Route("/pdf/{id}", name="read_pdf", methods={"GET"})
     */
    public function viewpdf(Request $request, PatientInformations $patientInformation): Response
    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $dompdf->loadHtml($patientInformation->getReport());
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("(".$patientInformation->getId().")".$patientInformation->getName(), [
            "Attachment" => false
        ]);

    }


    /**
     * @Route("/{id}/reportdone", name="report_done", methods={"GET"})
     */
    public function reportdone(Request $request, int $id, PatientInformationsRepository $patientInformationsRepository): Response
    {
        $Patient = $patientInformationsRepository->findOneBy(['id' => $id]);
        $Patient->setReportDone(true);
        $this->getDoctrine()->getManager()->persist($Patient);
        $this->getDoctrine()->getManager()->flush();
        return  $this->redirectToRoute('history_reports')   ;

    }






}







