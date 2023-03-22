<?php 

namespace App\Controller\Front;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

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
    public function material(UserRepository $userRepository, UserInterface $user):Response
    {   

        $id= $user->getId();

        $internalLocation = $userRepository->findInternalLocationWitdhUserId($id);
        $externalLocation = $userRepository->findExternalLocationWitdhUserId($id);

        return $this->render('front/user/material.html.twig',[
            'internal_location' => $internalLocation,
            'external_location' => $externalLocation,
        ]);
    }

}