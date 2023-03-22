<?php 

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{   
    /**
     * @Route("/utilisateur", name="user_information")
     *
     * @return Response
     */
    public function profil():Response
    {
        return $this->render('front/user/profil.html.twig');
    }

    /**
     * @Route("/utilisateur/demande/location", name="user_external_location")
     *
     * @return Response
     */
    public function material():Response
    {
        return $this->render('front/user/material.html.twig');
    }

}