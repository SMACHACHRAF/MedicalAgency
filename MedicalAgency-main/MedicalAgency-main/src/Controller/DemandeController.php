<?php

namespace App\Controller;

use App\Entity\PatientInformations;
use App\Form\DemandType;
use App\Form\PatientInfo2Type;
use App\Repository\PatientInformationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DemandeController extends AbstractController
{
    /**
     * @Route("/demande", name="demande")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {

        $demande = new PatientInformations();
        $form = $this->createForm(DemandType::class, $demande);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->persist($demande);
            $this->getDoctrine()->getManager()->flush();

            $message = (new \Swift_Message('Request Confirmation'))
                ->setFrom('medicalagency007@gmail.com')
                ->setTo($demande->getEmail())
                ->setBody(
                    $this->renderView('demande/email.html.twig', [
                        'email' => $demande->getEmail(),
                        'name' => $demande->getName(),
                        'id'=>$demande->getId(),
                        'expiration_date' => new \DateTime('+1 days'),
                    ])
                    , 'text/html');


            $this->getDoctrine()->getManager()->persist($demande);
            $this->getDoctrine()->getManager()->flush();
            $mailer->send($message);

            $this->addFlash('message', 'OK');
            return $this->redirectToRoute('requestsent');

        }

        return $this->render('demande/index.html.twig', [
            'requestForm' => $form->createView(),
        ]);
    }


    /**
     * @Route("/requestsent", name="requestsent")
     */
    public function confirm(Request $request, \Swift_Mailer $mailer)
    {
        return $this->render('demande/requestsent.html.twig');
    }


}
