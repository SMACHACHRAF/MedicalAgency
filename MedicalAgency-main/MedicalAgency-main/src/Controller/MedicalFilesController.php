<?php

namespace App\Controller;

use App\Entity\MedicalFiles;
use App\Entity\PatientInformations;
use App\Form\DoctorSelectType;
use App\Form\MedicalFiles1Type;
use App\Form\MedicalFilesType;
use App\Repository\MedicalFilesRepository;
use App\Repository\PatientInformationsRepository;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/medical/files")
 */
class MedicalFilesController extends AbstractController
{
    /**
     * @Route("/", name="medical_files_index", methods={"GET"})
     */
    public function index(MedicalFilesRepository $medicalFilesRepository): Response
    {
        $docteur = $this->getUser();

        return $this->render('medical_files/index.html.twig', [
            'medical_files' => $medicalFilesRepository->findBy(['is_approved' => 0, 'is_rejected' => 0]),
            'username' => $docteur->getUsername(),
            'email' => $docteur->getEmail(),
        ]);
    }

     /**
 * @Route("/approvedMedicalFiles", name="medical_files_accepted", methods={"GET"})
 */
    public  function approved_medical(MedicalFilesRepository $medicalFilesRepository): Response
    {
        $docteur = $this->getUser();

        return $this->render('medical_files/approve.html.twig', [
            'medical_files' => $medicalFilesRepository->findBy(['is_approved' => 1, 'is_rejected' => 0]),
            'username' => $docteur->getUsername(),
            'email' => $docteur->getEmail(),
        ]);
    }

    /**
     * @Route("/RejectedMedicalFiles", name="medical_files_rejected", methods={"GET"})
     */
    public  function rejected_medical(MedicalFilesRepository $medicalFilesRepository): Response
    {
        $docteur = $this->getUser();

        return $this->render('medical_files/rejected.html.twig', [
            'medical_files' => $medicalFilesRepository->findBy(['is_approved' => 0, 'is_rejected' => 1]),
            'username' => $docteur->getUsername(),
            'email' => $docteur->getEmail(),
        ]);
    }

    /**
     * @Route("/selectDoctor/{id}", name="doctor_select", methods={"GET","POST"})
     */
    public function doctorSelect(Request $request, int $id, MedicalFilesRepository $medicalFilesRepository, UsersRepository $usersRepository): Response
    {
        $docteur = $this->getUser();
        $array = [];
        foreach ($usersRepository->findBy(['Spec' => $medicalFilesRepository->findOneBy(['id' => $id])->getPatientInformations()->getSpecialisation()])
                 as $item) {
            $array[$item->getUsername()] = $item;
        }
        $medicalFile = $medicalFilesRepository->findOneBy(['id' => $id])->getPatientInformations();
        $form = $this->createFormBuilder($medicalFile)
            ->add('patient_doctor', ChoiceType::class, ['choices' => $array])
            ->add('save', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $this->getDoctrine()->getManager()->persist($medicalFile);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('medical_files_index');
        }

        return $this->render('medical_files/doctor_select.html.twig', [
            'patient' => $medicalFile->getName(),
            'spec' => $medicalFile -> getSpecialisation(),
            'form' => $form->createView(),
            'username' => $docteur->getUsername(),
            'email' => $docteur->getEmail(),
        ]);
    }


    /**
     * @Route("/new", name="medical_files_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $medicalFile = new MedicalFiles();
        $form = $this->createForm(MedicalFilesType::class, $medicalFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($medicalFile);
            $entityManager->flush();

            return $this->redirectToRoute('medical_files_index');
        }

        return $this->render('medical_files/new.html.twig', [
            'medical_file' => $medicalFile,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="medical_files_show", methods={"GET"})
     */
    public function show(MedicalFiles $medicalFile, PatientInformationsRepository $patientInformationsRepository) : Response
    {
        $docteur = $this->getUser();
        return $this->render('medical_files/show.html.twig', [
            'medical_file' => $medicalFile,
            'patient' => $patientInformationsRepository->findOneBy(['patient_folder' => $medicalFile->getId() ]),
            'username' => $docteur->getUsername(),
            'email' => $docteur->getEmail(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="medical_files_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MedicalFiles $medicalFile): Response
    {
        $form = $this->createForm(MedicalFilesType::class, $medicalFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('medical_files_index');
        }

        return $this->render('medical_files/edit.html.twig', [
            'medical_file' => $medicalFile,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="medical_files_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MedicalFiles $medicalFile): Response
    {
        if ($this->isCsrfTokenValid('delete' . $medicalFile->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($medicalFile);
            $entityManager->flush();
        }

        return $this->redirectToRoute('medical_files_index');
    }

    /**
     *
     * @Route("/reject/{id}", name="medicale_files_reject")
     */
    public function reject(Request $request,PatientInformationsRepository $patientInformationsRepository, MedicalFiles $medicalFiles,\Swift_Mailer $mailer, MedicalFilesRepository $medicalFilesRepository): Response
    {

        $patient = $patientInformationsRepository->findOneBy(['patient_folder' => $medicalFiles->getId() ]);
        $docteur = $this->getUser();
        $form = $this->createFormBuilder()
            ->add('RejectReason', TextareaType::class)
            ->add('Send', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $medicalFiles->setIsRejected(1);
            $medicalFiles->setIsApproved(0);
            $message = (new \Swift_Message('Reject Reason'))
                ->setFrom('medicalagency007@gmail.com')
                ->setTo( $patient->getEmail())
                ->setBody(
                    $this->renderView('patient_informations/rejectmail.html.twig', [
                        'form' => $form->getData(),
                        'email' => $patient->getEmail(),
                        'name' =>$patient->getName(),
                        'id' => $patient->getId(),
                    ])
                    , 'text/html');

            $mailer->send($message);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('medical_files_index');

        }
        return $this->render('medical_files/rejectmail.html.twig', [
            'form' => $form->createView(),
            'data' => $medicalFiles->getPatientInformations(),
            'username' => $docteur->getUsername(),
            'email' => $docteur->getEmail(),
        ]);

    }

    /**
     * @Route("/approve/{id}", name="medicale_files_approve")
     */
    public function approve(Request $request, MedicalFiles $medicalFiles): Response
    {
        $medicalFiles->setIsRejected(0);
        $medicalFiles->setIsApproved(1);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('medical_files_index');

    }

}
