<?php

namespace App\Controller\Front;

use App\Entity\ExternalLocation;
use App\Form\ExternalLocationFrontType;
use App\Repository\ExternalLocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/front/external/location")
 */
class ExternalLocationController extends AbstractController
{
    
    /**
     * @Route("/new", name="app_front_external_location_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ExternalLocationRepository $externalLocationRepository, UserInterface $user): Response
    {   

        $externalLocation = new ExternalLocation();
        $form = $this->createForm(ExternalLocationFrontType::class, $externalLocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $externalLocation->setUser($user);
            $externalLocation->setAccepted('Non');
            $externalLocationRepository->add($externalLocation, true);
            

            return $this->redirectToRoute('user_external_location', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/external_location/new.html.twig', [
            'external_location' => $externalLocation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_front_external_location_show", methods={"GET"})
     */
    public function show(ExternalLocation $externalLocation): Response
    {
        return $this->render('front/external_location/show.html.twig', [
            'external_location' => $externalLocation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_front_external_location_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ExternalLocation $externalLocation, ExternalLocationRepository $externalLocationRepository): Response
    {
        $form = $this->createForm(ExternalLocationFrontType::class, $externalLocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $externalLocationRepository->add($externalLocation, true);

            return $this->redirectToRoute('user_external_location', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/external_location/edit.html.twig', [
            'external_location' => $externalLocation,
            'form' => $form,
        ]);
    }

   
}
