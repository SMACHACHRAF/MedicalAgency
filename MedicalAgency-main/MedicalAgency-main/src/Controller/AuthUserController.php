<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AuthUserController extends AbstractController
{
    /**
     * @Route("/auth/users", name="auth_user")
     */
    public function index()
    {
        return $this->render('auth_user/index.html.twig', [
            'controller_name' => 'AuthUserController',
        ]);
    }
}
