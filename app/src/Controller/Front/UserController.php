<?php 

namespace App\Controller\Front;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class UserController extends AbstractController
{   
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/utilisateur", name="user_information")
     *
     * @return Response
     */
    public function profil(UserInterface $user, UserRepository $userRepository):Response
    {   
        $id= $user->getId();

        $internalLocation = $userRepository->findInternalLocationWitdhUserId($id);
    
        return $this->render('front/user/profil.html.twig',[
            'user' =>$user,
            'internal_locations' => $internalLocation
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/utilisateur/demande/location", name="user_external_location")
     *
     * @return Response
     */
    public function material(UserRepository $userRepository, UserInterface $user):Response
    {   

        $id= $user->getId();

        $externalLocation = $userRepository->findExternalLocationWitdhUserId($id);


        return $this->render('front/user/material.html.twig',[
            'external_locations' => $externalLocation,
        ]);
    }

}