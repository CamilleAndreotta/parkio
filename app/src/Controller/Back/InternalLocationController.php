<?php

namespace App\Controller\Back;

use App\Entity\InternalLocation;
use App\Form\InternalLocationType;
use App\Repository\InternalLocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/internal/location")
 */
class InternalLocationController extends AbstractController
{
    /**
     * @Route("/", name="app_back_internal_location_index", methods={"GET"})
     */
    public function index(InternalLocationRepository $internalLocationRepository): Response
    {
        return $this->render('back/internal_location/index.html.twig', [
            'internal_locations' => $internalLocationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_back_internal_location_new", methods={"GET", "POST"})
     */
    public function new(Request $request, InternalLocationRepository $internalLocationRepository): Response
    {
        $internalLocation = new InternalLocation();
        $form = $this->createForm(InternalLocationType::class, $internalLocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $internalLocationRepository->add($internalLocation, true);

            return $this->redirectToRoute('app_back_internal_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/internal_location/new.html.twig', [
            'internal_location' => $internalLocation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_internal_location_show", methods={"GET"})
     */
    public function show(InternalLocation $internalLocation): Response
    {
        return $this->render('back/internal_location/show.html.twig', [
            'internal_location' => $internalLocation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_back_internal_location_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, InternalLocation $internalLocation, InternalLocationRepository $internalLocationRepository): Response
    {
        $form = $this->createForm(InternalLocationType::class, $internalLocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $internalLocationRepository->add($internalLocation, true);

            return $this->redirectToRoute('app_back_internal_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/internal_location/edit.html.twig', [
            'internal_location' => $internalLocation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_internal_location_delete", methods={"POST"})
     */
    public function delete(Request $request, InternalLocation $internalLocation, InternalLocationRepository $internalLocationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$internalLocation->getId(), $request->request->get('_token'))) {
            $internalLocationRepository->remove($internalLocation, true);
        }

        return $this->redirectToRoute('app_back_internal_location_index', [], Response::HTTP_SEE_OTHER);
    }
}
