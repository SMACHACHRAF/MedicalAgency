<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersType;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("admin/users")
 */
class UsersController extends AbstractController
{
    /**
     * @Route("/", name="users_index", methods={"GET"})
     */
    public function index(UsersRepository $usersRepository): Response
    {
            $docteur = $this->getUser();
        return $this->render('users/index.html.twig', [
            'users' => $usersRepository->findAll(),
            'username' => $docteur->getUsername(),
            'email' => $docteur->getEmail(),
        ]);
    }

    /**
     * @Route("/new", name="users_new", methods={"GET","POST"})
     */
    public function new(Request $request,UserPasswordEncoderInterface $passwordEncoder,\Swift_Mailer $mailer): Response
    {
        $docteur = $this->getUser();
        $user = new Users();
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(array('ROLE_DOCTOR'));
            $alphabet = '1234567890';
            $pass = ''; //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 6; $i++) {
                $n = rand(0, $alphaLength);
                $pass = $pass . $alphabet[$n];
            }
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $pass
                )
            );
            $message = (new \Swift_Message('Login Informations'))
                ->setFrom('medicalagency007@gmail.com')
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView('users/info_auth.html.twig', [
                        'email' => $user->getEmail(),
                        'name' => $user->getUsername(),
                        'pass' => $pass
                    ])
                    , 'text/html');
            $mailer->send($message);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();


            return $this->redirectToRoute('users_index');
        }

        return $this->render('users/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'username' => $docteur->getUsername(),
            'email' => $docteur->getEmail(),
        ]);
    }

    /**
     * @Route("/{id}", name="users_show", methods={"GET"})
     */
    public function show(Users $user): Response
    {
        $docteur = $this->getUser();

        return $this->render('users/show.html.twig', [
            'user' => $user,
            'username' => $docteur->getUsername(),
            'email' => $docteur->getEmail(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="users_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Users $user): Response
    {
        $docteur = $this->getUser();
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('users_index');
        }

        return $this->render('users/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'username' => $docteur->getUsername(),
            'email' => $docteur->getEmail(),
        ]);
    }

    /**
     * @Route("/{id}", name="users_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Users $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('users_index');
    }
}
