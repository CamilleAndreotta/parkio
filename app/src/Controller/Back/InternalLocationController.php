<?php

namespace App\Controller\Back;

use App\Entity\InternalLocation;
use App\Entity\Keyboard;
use App\Form\InternalLocationType;

use App\Repository\MouseRepository;
use App\Repository\LaptopRepository;
use App\Repository\MonitorRepository;
use App\Repository\ComputerRepository;
use App\Repository\KeyboardRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\VideoprojectorRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\InternalLocationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Services\ChangeStatusNotAvailable\UpdateLaptopStatus;
use App\Services\ChangeStatusNotAvailable\UpdateMouseStatus; 
use App\Services\ChangeStatusNotAvailable\UpdateComputerStatus;
use App\Services\ChangeStatusNotAvailable\UpdateKeyboardStatus; 
use App\Services\ChangeStatusNotAvailable\UpdateMonitorStatus;
use App\Services\ChangeStatusNotAvailable\UpdateVideoprojectorStatus;

use App\Services\KeepMaterialsIfEmpty\KeepComputers;
use App\Services\KeepMaterialsIfEmpty\KeepKeyboards;
use App\Services\KeepMaterialsIfEmpty\KeepLaptops;
use App\Services\KeepMaterialsIfEmpty\KeepMonitors;
use App\Services\KeepMaterialsIfEmpty\KeepMouses;
use App\Services\KeepMaterialsIfEmpty\KeepVideoprojectors;

/**
 * @Route("/back/internal/location")
 */
class InternalLocationController extends AbstractController
{
    
    private $laptopRepository;
    private $computerRepository; 
    private $monitorRepository; 
    private $videoprojectorRepository; 
    private $mouseRepository;
    private $keyboardRepository;
    private $internalLocationRepository;

    private $updateLaptopStatus;
    private $updateComputerStatus; 
    private $updateMonitorStatus;
    private $updateVideoprojectorStatus;
    private $updateMouseStatus;
    private $updateKeyboardStatus;

    private $keepComputers; 
    private $keepLaptops;
    private $keepMonitors;
    private $keepVideoprojectors;
    private $keepMouses; 
    private $keepKeyboards;


    private $em; 


    public function __construct(
        
        LaptopRepository $laptopRepository, 
        ComputerRepository $computerRepository, 
        MonitorRepository $monitorRepository, 
        VideoprojectorRepository $videoprojectorRepository, 
        MouseRepository $mouseRepository, 
        KeyboardRepository $keyboardRepository, 
        InternalLocationRepository $internalLocationRepository,

        UpdateLaptopStatus $updateLaptopStatus, 
        UpdateComputerStatus $updateComputerStatus, 
        UpdateMonitorStatus $updateMonitorStatus, 
        UpdateVideoprojectorStatus $updateVideoprojectorStatus, 
        UpdateMouseStatus $updateMouseStatus, 
        UpdateKeyboardStatus $updateKeyboardStatus, 

        KeepComputers $keepComputers,
        KeepLaptops $keepLaptops,
        KeepMonitors $keepMonitors,
        KeepVideoprojectors $keepVideoprojectors,
        KeepMouses $keepMouses, 
        KeepKeyboards $keepKeyboards,
        

        EntityManagerInterface $em ){

        $this->laptopRepository =  $laptopRepository; 
        $this->computerRepository = $computerRepository;
        $this->monitorRepository = $monitorRepository; 
        $this->mouseRepository = $mouseRepository; 
        $this->videoprojectorRepository = $videoprojectorRepository; 
        $this->keyboardRepository = $keyboardRepository;
        $this->internalLocationRepository = $internalLocationRepository;

        $this->updateLaptopStatus = $updateLaptopStatus;
        $this->updateComputerStatus = $updateComputerStatus;
        $this->updateMonitorStatus = $updateMonitorStatus;
        $this->updateVideoprojectorStatus = $updateVideoprojectorStatus;
        $this->updateMouseStatus = $updateMouseStatus;
        $this->updateKeyboardStatus = $updateKeyboardStatus;

        $this->keepComputers = $keepComputers;
        $this->keepLaptops = $keepLaptops;
        $this->keepMonitors = $keepMonitors;
        $this->keepVideoprojectors = $keepVideoprojectors;
        $this->keepMouses = $keepMouses;
        $this->keepKeyboards = $keepKeyboards;

        $this->em = $em; 

    }
    
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

            /** Manage status of all materials in submission of form with services */
            
            $this->updateComputerStatus->updateStatus($form,$this->computerRepository, $this->internalLocationRepository, $this->em);

            $this->updateLaptopStatus->updateStatus($form, $this->laptopRepository,$this->internalLocationRepository, $this->em);
   
            $this->updateMonitorStatus->updateStatus($form, $this->monitorRepository, $this->internalLocationRepository, $this->em);
        
            $this->updateVideoprojectorStatus->updateStatus($form, $this->videoprojectorRepository, $this->internalLocationRepository, $this->em);
        
            $this->updateMouseStatus->updateStatus($form, $this->mouseRepository, $this->internalLocationRepository, $this->em);
        
            $this->updateKeyboardStatus->updateStatus($form, $this->keyboardRepository, $this->internalLocationRepository, $this->em);

        
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

            $computersData = $form->getData()->getComputer()->getValues();
            $laptopsData = $form->getData()->getLaptop()->getValues();
            $monitorsData = $form->getData()->getMonitor()->getValues();
            $videoprojectorsData = $form->getData()->getVideoprojector()->getValues();
            $mousesData = $form->getData()->getMouse()->getValues();
            $keyboardsData = $form->getData()->getKeyboard()->getValues();

            if($computersData === []){
                $this->keepComputers->keepMaterial($form, $this->internalLocationRepository, $this->computerRepository, $this->em);
            }else{
                $this->updateComputerStatus->updateStatus($form, $this->computerRepository, $this->internalLocationRepository, $this->em);
            }

            if($laptopsData === []){
                $this->keepLaptops->keepMaterial($form, $this->internalLocationRepository, $this->laptopRepository, $this->em);
            }else{
                $this->updateLaptopStatus->updateStatus($form, $this->laptopRepository, $this->internalLocationRepository, $this->em);
            }
            
            if($monitorsData === []){
                $this->keepMonitors->keepMaterial($form, $this->internalLocationRepository, $this->monitorRepository, $this->em);
            }else{
                $this->updateMonitorStatus->updateStatus($form, $this->monitorRepository, $this->internalLocationRepository, $this->em);
            } 

            if($videoprojectorsData === []){
                $this->keepVideoprojectors->keepMaterial($form, $this->internalLocationRepository, $this->videoprojectorRepository, $this->em);
            }else{
                $this->updateVideoprojectorStatus->updateStatus($form, $this->videoprojectorRepository, $this->internalLocationRepository, $this->em);
            } 

            if($mousesData === []){
                $this->keepMouses->keepMaterial($form, $this->internalLocationRepository, $this->mouseRepository, $this->em);
            }else{
                $this->updateMouseStatus->updateStatus($form, $this->mouseRepository, $this->internalLocationRepository, $this->em);
            } 
            
            if($keyboardsData === []){
                $this->keepKeyboards->keepMaterial($form, $this->internalLocationRepository, $this->keyboardRepository, $this->em);
            }else{
                $this->updateKeyboardStatus->updateStatus($form, $this->keyboardRepository, $this->internalLocationRepository, $this->em);
            } 

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
