<?php

namespace App\Controller\Back;

use App\Entity\ExternalLocation;
use App\Form\ExternalLocationType;
use App\Repository\ExternalLocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

use App\Repository\LaptopRepository;
use App\Repository\MouseRepository;

use App\Services\ChangeMaterialStatus\LaptopStatusExternal;
use App\Services\ChangeMaterialStatus\MouseStatusExternal;

use App\Services\KeepMaterialInLocation\KeepLaptopStatusExternal;
use App\Services\KeepMaterialInLocation\KeepMouseStatusExternal;


/**
 * @Route("/back/external/location")
 */
class ExternalLocationController extends AbstractController
{   

    private $laptopRepository;
    private $mouseRepository;

    private $laptopStatusExternal;
    private $mouseStatusExternal;

    private $keepLaptopStatusExternal;
    private $keepMouseStatusExternal;

    private $externalLocationRepository;

    private $em; 

    public function __construct(

        LaptopRepository $laptopRepository,
        MouseRepository $mouseRepository, 

        LaptopStatusExternal $laptopStatusExternal,
        MouseStatusExternal $mouseStatusExternal,

        KeepLaptopStatusExternal $keepLaptopStatusExternal,
        KeepMouseStatusExternal $keepMouseStatusExternal,

        ExternalLocationRepository $externalLocationRepository,

        EntityManagerInterface $em 

    ){

        $this->laptopRepository =  $laptopRepository; 
        $this->mouseRepository = $mouseRepository; 

        $this->laptopStatusExternal = $laptopStatusExternal;
        $this->mouseStatusExternal = $mouseStatusExternal; 

        $this->keepLaptopStatusExternal = $keepLaptopStatusExternal;
        $this->keepMouseStatusExternal = $keepMouseStatusExternal; 

        $this->externalLocationRepository = $externalLocationRepository;

        $this->em = $em; 

    }




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

            $this->laptopStatusExternal->updateStatus($form, $this->externalLocationRepository, $this->laptopRepository, $this->em);

            $this->mouseStatusExternal->updateStatus($form, $this->externalLocationRepository, $this->mouseRepository, $this->em);

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


            if ($form->getData()->getLaptop() !== null) {

                $this->laptopStatusExternal->updateStatus($form, $this->externalLocationRepository, $this->laptopRepository, $this->em);

            } else {

                $this->keepLaptopStatusExternal->updateStatus($form, $this->externalLocationRepository, $this->laptopRepository, $this->em);

            }

            if ($form->getData()->getMouse() !== null) {

                $this->mouseStatusExternal->updateStatus($form, $this->externalLocationRepository, $this->mouseRepository, $this->em);

            } else {

                $this->keepMouseStatusExternal->updateStatus($form, $this->externalLocationRepository, $this->mouseRepository, $this->em);

            }


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
