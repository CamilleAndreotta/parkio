<?php

namespace App\Controller\Front;

use App\Entity\InternalLocation;
use App\Form\InternalLocationFrontType;
use App\Repository\InternalLocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/front/internal/location")
 */
class InternalLocationController extends AbstractController
{
    
    /**
     * @Route("/new", name="app_front_internal_location_new", methods={"GET", "POST"})
     */
    public function new(Request $request, InternalLocationRepository $internalLocationRepository, UserInterface $user): Response
    {

        $internalLocation = new InternalLocation();

        $form = $this->createForm(InternalLocationFrontType::class, $internalLocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $internalLocation->setUser($user);
            $internalLocation->setAccepted('Non');
            $internalLocationRepository->add($internalLocation, true);
            

            return $this->redirectToRoute('user_information', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/internal_location/new.html.twig', [
            'internal_location' => $internalLocation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_front_internal_location_show", methods={"GET"})
     */
    public function show(InternalLocation $internalLocation): Response
    {
        return $this->render('front/internal_location/show.html.twig', [
            'internal_location' => $internalLocation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_front_internal_location_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, InternalLocation $internalLocation, InternalLocationRepository $internalLocationRepository): Response
    {   

        $form = $this->createForm(InternalLocationFrontType::class, $internalLocation);
        $form->handleRequest($request);

        $id = $form->getData()->getId();

        if ($form->isSubmitted() && $form->isValid()) {

            $internalLocationRepository->add($internalLocation, true);
            
            return $this->redirectToRoute('user_information', [], Response::HTTP_SEE_OTHER);
            
        }

        return $this->renderForm('front/internal_location/edit.html.twig', [
            
            'internal_location' => $internalLocation,
            'form' => $form,

        ]);
    }

}
