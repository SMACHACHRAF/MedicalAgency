<?php

namespace App\Controller;

use App\Entity\PatientInformations;
use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('homepage/index.html.twig', [
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('homepage/about.html.twig', [
        ]);
    }



    /**
     * @Route("/department", name="department")
     */
    public function department()
    {
        return $this->render('homepage/department.html.twig', [
        ]);
    }

    /**
     * @Route("/blog", name="blog")
     */
    public function blog()
    {
        return $this->render('homepage/blog.html.twig', [
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createFormBuilder()
            ->add('Message', TextareaType::class)
            ->add("Subject", TextType::class)
            ->add("Email", EmailType::class)
            ->add("Send", SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $message = (new \Swift_Message($form->getData()['Subject']))
                ->setFrom('medicalagency007@gmail.com')
                ->setTo('medicalagency007@gmail.com')
                ->setBody($form->getData()['Message'].' '.$form->getData()['Email'] );
            $mailer->send($message);

        }
        return $this->render('homepage/contact.html.twig',['form'=>$form->createView()]);

    }

    /**
     * @Route("/team", name="team")
     */
    public function team()
    {
        return $this->render('homepage/team.html.twig', [
        ]);
    }

}
