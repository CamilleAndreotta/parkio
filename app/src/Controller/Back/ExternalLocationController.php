<?php

namespace App\Controller\Back;

use App\Entity\ExternalLocation;
use App\Form\ExternalLocationType;
use App\Repository\ExternalLocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/external/location")
 */
class ExternalLocationController extends AbstractController
{
    /**
     * @Route("/", name="app_back_external_location_index", methods={"GET"})
     */
    public function index(ExternalLocationRepository $externalLocationRepository): Response
    {
        return $this->render('back/external_location/index.html.twig', [
            'external_locations' => $externalLocationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_back_external_location_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ExternalLocationRepository $externalLocationRepository): Response
    {
        $externalLocation = new ExternalLocation();
        $form = $this->createForm(ExternalLocationType::class, $externalLocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $externalLocationRepository->add($externalLocation, true);

            return $this->redirectToRoute('app_back_external_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/external_location/new.html.twig', [
            'external_location' => $externalLocation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_external_location_show", methods={"GET"})
     */
    public function show(ExternalLocation $externalLocation): Response
    {
        return $this->render('back/external_location/show.html.twig', [
            'external_location' => $externalLocation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_back_external_location_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ExternalLocation $externalLocation, ExternalLocationRepository $externalLocationRepository): Response
    {
        $form = $this->createForm(ExternalLocationType::class, $externalLocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $externalLocationRepository->add($externalLocation, true);

            return $this->redirectToRoute('app_back_external_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/external_location/edit.html.twig', [
            'external_location' => $externalLocation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_external_location_delete", methods={"POST"})
     */
    public function delete(Request $request, ExternalLocation $externalLocation, ExternalLocationRepository $externalLocationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$externalLocation->getId(), $request->request->get('_token'))) {
            $externalLocationRepository->remove($externalLocation, true);
        }

        return $this->redirectToRoute('app_back_external_location_index', [], Response::HTTP_SEE_OTHER);
    }
}
