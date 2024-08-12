<?php

namespace App\Controller;

use App\Entity\MedicalCity;
use App\Entity\TourismeRegion;
use App\Form\DemandType;
use App\Repository\MedicalCityRepository;
use App\Entity\PatientInformations;
use App\Form\PatientInformationsType;
use App\Repository\MedicalFilesRepository;
use App\Repository\PatientInformationsRepository;
use App\Repository\SpecialisationRepository;
use App\Repository\UsersRepository;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

/**
 * @Route("/admin/patient/informations")
 */
class PatientInformationsController extends AbstractController
{

    /**
     *
     * @Route("/stat", name="stat", methods={"GET"})
     */
    function stat(Request $request, PatientInformationsRepository $patientInformationsRepository, MedicalFilesRepository $repository, SpecialisationRepository $spec, UsersRepository $usersRepository)
    {
        $docteur = $this->getUser();
        $all = $patientInformationsRepository->findAll();

        $approved = $patientInformationsRepository->findBy(['isApproved' => true]);
        $rejected = $patientInformationsRepository->findBy(['isRejected' => true]);
        $pending = $patientInformationsRepository->findBy(['isRejected' => false, 'isApproved' => false]);
        $specs = array();
        $specsVal = array();

        $test = count($all);
        if ($test == 0) {
            $test = 1;
        }



        foreach ($spec->findAll() as $value) {
            dump($value);
            dump(count($usersRepository->findBy(['Spec' => $value])));
            array_push($specsVal,count($usersRepository->findBy(['Spec' => $value])));
        }
        foreach ($spec->findAll() as $specialisation) {
            array_push($specs, $specialisation->getSpec());
        }


        return $this->render('patient_informations/stat.html.twig', [
            'username' => $docteur->getUsername(),
            'email' => $docteur->getEmail(),
            'approved' => count($approved) * 100 / $test,
            'rejected' => count($rejected) * 100 / $test,
            'pending' => count($pending) * 100 / $test,
            'all' => count($all),
            'spec' => $specs,
            'specVal'=>$specsVal
        ]);
    }


    /**
     * @Route("/", name="patient_informations_index", methods={"GET"})
     */
    public function index(PatientInformationsRepository $patientInformationsRepository): Response
    {
        $docteur = $this->getUser();

        return $this->render('patient_informations/index.html.twig', [
            'patient_informations' => $patientInformationsRepository->findBy(['isApproved' => 0, 'isRejected' => 0]),
            'username' => $docteur->getUsername(),
            'email' => $docteur->getEmail(),
        ]);
    }

    /**
     * @Route("/approvedInformations", name="patient_informations_approved", methods={"GET"})
     */
    public function approvedInformations(PatientInformationsRepository $patientInformationsRepository): Response
    {
        $docteur = $this->getUser();

        return $this->render('patient_informations/approve.html.twig', [
            'patient_informations' => $patientInformationsRepository->findBy(['isApproved' => 1]),
            'username' => $docteur->getUsername(),
            'email' => $docteur->getEmail(),
        ]);
    }

    /**
     * @Route("/rejectedInformations", name="patient_informations_rejected", methods={"GET"})
     */
    public function rejectedInformations(PatientInformationsRepository $patientInformationsRepository): Response
    {
        $docteur = $this->getUser();

        return $this->render('patient_informations/reject.html.twig', [
            'patient_informations' => $patientInformationsRepository->findBy(['isRejected' => 1]),
            'username' => $docteur->getUsername(),
            'email' => $docteur->getEmail(),
        ]);
    }

    /**
     * @Route("/invoices", name="invoices", methods={"GET"})
     */

    public function invoices(PatientInformationsRepository $patientInformationsRepository): Response
    {
        $docteur = $this->getUser();

        return $this->render('patient_informations/invoice.html.twig', [
            'patient_informations' => $patientInformationsRepository->findBy([
                'report_done' => true
            ]),
            'username' => $docteur->getUsername(),
            'email' => $docteur->getEmail(),
        ]);
    }


    /**
     * @Route("/new", name="patient_informations_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $patientInformation = new PatientInformations();
        $form = $this->createForm(PatientInformationsType::class, $patientInformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($patientInformation);
            $entityManager->flush();

            return $this->redirectToRoute('patient_informations_index');
        }

        return $this->render('patient_informations/new.html.twig', [
            'patient_information' => $patientInformation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="patient_informations_show", methods={"GET"})
     */
    public function show(PatientInformations $patientInformation): Response
    {
        $docteur = $this->getUser();
        return $this->render('patient_informations/show.html.twig', [
            'patient_information' => $patientInformation,
            'username' => $docteur->getUsername(),
            'email' => $docteur->getEmail(),

        ]);
    }

    /**
     * @Route("/{id}/edit", name="patient_informations_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PatientInformations $patientInformation): Response
    {
        $form = $this->createForm(DemandType::class, $patientInformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('patient_informations_index');
        }

        return $this->render('patient_informations/edit.html.twig', [
            'patient_information' => $patientInformation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="patient_informations_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PatientInformations $patientInformation): Response
    {
        if ($this->isCsrfTokenValid('delete' . $patientInformation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($patientInformation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('patient_informations_index');
    }

    /**
     *
     * @Route("/approve/{id}", name="patient_informations_approve")
     */
    public function approve(Request $request, \Swift_Mailer $mailer, PatientInformations $patientInformation, PatientInformationsRepository $repository): Response
    {
        $patientInformation->setIsApproved(1);
        $patientInformation->setIsRejected(0);
        $patientInformation->getEmail();
        $message = (new \Swift_Message('FILE Confirmation'))
            ->setFrom('medicalagency007@gmail.com')
            ->setTo($patientInformation->getEmail())
            ->setBody(
                $this->renderView('file_upload/email.html.twig', [
                    'email' => $patientInformation->getEmail(),
                    'name' => $patientInformation->getName(),
                    'id' => $patientInformation->getId(),
                    'expiration_date' => new \DateTime('+1 days'),
                ])
                , 'text/html');
        $mailer->send($message);
        $this->getDoctrine()->getManager()->flush();


        return $this->redirectToRoute('patient_informations_index');


    }

    /**
     *
     * @Route("/reject/{id}", name="patient_informations_reject")
     */
    public function reject(Request $request, PatientInformations $patientInformation, \Swift_Mailer $mailer): Response
    {
        $docteur = $this->getUser();
        $form = $this->createFormBuilder()
            ->add('RejectReason', TextareaType::class)
            ->add('Send', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $patientInformation->setIsRejected(1);
            $patientInformation->setIsApproved(0);
            $message = (new \Swift_Message('Reject Reason'))
                ->setFrom('medicalagency007@gmail.com')
                ->setTo($patientInformation->getEmail())
                ->setBody(
                    $this->renderView('patient_informations/rejectmail.html.twig', [
                        'email' => $patientInformation->getEmail(),
                        'name' => $patientInformation->getName(),
                        'id' => $patientInformation->getId(),
                        'expiration_date' => new \DateTime('+1 days'),
                    ])
                    , 'text/html');

            $mailer->send($message);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('patient_informations_index');
        }
        return $this->render('patient_informations/reject_reason.html.twig', [
            'form' => $form->createView(),
            'data' => $patientInformation,
            'username' => $docteur->getUsername(),
            'email' => $docteur->getEmail(),
        ]);


    }


    /**
     *
     * @Route("/quote/{id}", name="pdf_quote")
     */

    public function quote(Request $request, PatientInformations $patientInformations, \Swift_Mailer $mailer)
    {
        $docteur = $this->getUser();

        if ($patientInformations->getTourismeRegion()->getCar() && $patientInformations->getTourismeRegion()->getGuide()) {
            $form = $this->createFormBuilder()
                ->add('MedicalOperationCost', MoneyType::class, ['currency' => 'USD'])
                ->add('FlightTicket', MoneyType::class, ['currency' => 'USD'])
                ->add("housingCost", MoneyType::class, ['currency' => 'USD'])
                ->add('carCost', MoneyType::class, ['currency' => 'USD'])
                ->add('guideCost', MoneyType::class, ['currency' => 'USD'])
                ->add("date", DateType::class, ['data' => $patientInformations->getTourismeRegion()->getArrivalDate()])
                ->add('Somme', MoneyType::class, ['currency' => 'USD'])
                ->add('Send', SubmitType::class)
                ->getForm();
        } else if (!empty($patientInformations->getTourismeRegion()->getCar())) {
            $form = $this->createFormBuilder()
                ->add('MedicalOperationCost', MoneyType::class, ['currency' => 'USD'])
                ->add('FlightTicket', MoneyType::class, ['currency' => 'USD'])
                ->add("housingCost", MoneyType::class, ['currency' => 'USD'])
                ->add('carCost', MoneyType::class, ['currency' => 'USD'])
                ->add("date", DateType::class, ['data' => $patientInformations->getTourismeRegion()->getArrivalDate()])
                ->add('Somme', MoneyType::class, ['currency' => 'USD'])
                ->add('Send', SubmitType::class)
                ->getForm();
        } else if (!empty($patientInformations->getTourismeRegion()->getGuide())) {
            $form = $this->createFormBuilder()
                ->add('MedicalOperationCost', MoneyType::class, ['currency' => 'USD'])
                ->add('FlightTicket', MoneyType::class, ['currency' => 'USD'])
                ->add("housingCost", MoneyType::class, ['currency' => 'USD'])
                ->add('guideCost', MoneyType::class, ['currency' => 'USD'])
                ->add("date", DateType::class, ['data' => $patientInformations->getTourismeRegion()->getArrivalDate()])
                ->add('Somme', MoneyType::class, ['currency' => 'USD'])
                ->add('Send', SubmitType::class)
                ->getForm();
        } else {
            $form = $this->createFormBuilder()
                ->add('MedicalOperationCost', MoneyType::class, ['currency' => 'USD'])
                ->add('FlightTicket', MoneyType::class, ['currency' => 'USD'])
                ->add("housingCost", MoneyType::class, ['currency' => 'USD'])
                ->add("date", DateType::class, ['data' => $patientInformations->getTourismeRegion()->getArrivalDate()])
                ->add('Somme', MoneyType::class, ['currency' => 'USD'])
                ->add('Send', SubmitType::class)
                ->getForm();
        }


        if ($patientInformations->getHousing()->getPlace() == 'I am in charge'
        ) {
            $form->remove('housingCost');
        }
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            //dump($patientInformations);
            // dd($form->getData());
            $this->getDoctrine()->getManager()->persist($patientInformations->setPatientConfirmed(0));
            $this->getDoctrine()->getManager()->persist($patientInformations->setPatientNotConfirmed(0));

            $this->getDoctrine()->getManager()->persist($patientInformations->getTourismeRegion()->setArrivalDate($form->getData()['date']));
            $this->getDoctrine()->getManager()->persist($patientInformations->setInvoiceSent(true));

            $this->getDoctrine()->getManager()->flush();

            //return $this->redirectToRoute('medical_files_index');

            // Instantiate Dompdf with our options
            $dompdf = new Dompdf();

            // Retrieve the HTML generated in our twig file
            $html = $this->renderView('patient_informations/facture.html.twig', [
                'form' => $form->getData(),
                'data' => $patientInformations,
                'date' => new \DateTime()
            ]);


            // Load HTML to Dompdf
            $dompdf->loadHtml($html);

            // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
            $dompdf->setPaper('A4', 'portrait');

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to Browser (force download)
            $output = $dompdf->output();

            // In this case, we want to write the file in the public directory
            $publicDirectory = $this->getParameter('kernel.project_dir') . '/public/factures';

            $pdfFilepath = $publicDirectory . '/facture ' . $patientInformations->getName() . '(' . $patientInformations->getId() . ').pdf';

            // Write file to the desired path
            file_put_contents($pdfFilepath, $output);
            $message = (new \Swift_Message('Devis'))
                ->setFrom('medicalagency007@gmail.com')
                ->setTo($patientInformations->getEmail())
                ->setBody(
                    $this->renderView('patient_informations/test.html.twig', [
                        'email' => $patientInformations->getEmail(),
                        'name' => $patientInformations->getName(),
                        'id' => $patientInformations->getId()
                    ])
                    , 'text/html')
                ->attach(\Swift_Attachment::fromPath($pdfFilepath));
                $mailer->send($message);
                return $this->redirectToRoute("invoices");


        }

        return $this->render('patient_informations/pdf.html.twig', [
            'form' => $form->createView(),
            'data' => $patientInformations,
            'username' => $docteur->getUsername(),
            'email' => $docteur->getEmail(),
            'medical_file' => $patientInformations->getPatientFolder()->getMedicalFileName(),

        ]);
    }


    /**
     * @Route("/downpdf/{id}", name="down_pdf_admin", methods={"GET"})
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
     * @Route("/pdfs/{id}", name="read_pdfs", methods={"GET"})
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


}
