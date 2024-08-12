<?php

namespace App\Controller;

use App\Entity\CurrentDisease;
use App\Entity\CurrentTreatments;
use App\Entity\FolderInformations;
use App\Entity\MedicalFiles;
use App\Entity\PatientInformations;
use App\Form\FolderInfoType;
use App\Form\MedicalFilesType;
use App\Repository\MedicalCityRepository;
use App\Repository\PatientInformationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class FileUploadController extends AbstractController
{
    /**
     * @Route("/file/upload/{email}/{id}", name="file_upload")
     * @param $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request,String $email,int $id,MedicalCityRepository $repository,PatientInformationsRepository $patientInformationsRepository,PatientInformations $patientInformations)
    {
        if ($patientInformations->getPatientFolder() != null)
        {
        return $this->render('file_upload/emailconfirmed.html.twig', [
        ]);
        }
        $product = new MedicalFiles();
        $Current = new CurrentDisease();

        $test = new CurrentTreatments();

        $form = $this->createForm(MedicalFilesType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setEmailConfirmed(true);
            $this->getDoctrine()->getManager()->persist($product);
            //$this->getDoctrine()->getManager()->persist($Current->setMedicalFiles());
            $this->getDoctrine()->getManager()->persist($patientInformationsRepository->findOneBy(['id'=>$id])->setPatientFolder($product));

            $this->getDoctrine()->getManager()->flush();
            $this->redirectToRoute('homepage');

        }
        return $this->render('file_upload/index.html.twig', [
            'UploadForm' => $form->createView(),
            'file' => $product,
        ]);
    }
}
