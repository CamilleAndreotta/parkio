<?php

namespace App\Controller\Back;

use App\Entity\InternalLocation;
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

use App\Services\NotAvailable\UpdateLaptopStatus;
use App\Services\NotAvailable\UpdateMouseStatus; 
use App\Services\NotAvailable\UpdateComputerStatus;
use App\Services\NotAvailable\UpdateKeyboardStatus; 
use App\Services\NotAvailable\UpdateMonitorStatus;
use App\Services\NotAvailable\UpdateVideoprojectorStatus;

use function PHPUnit\Framework\isEmpty;

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
            
            $this->updateComputerStatus->updateStatus($form, $this->computerRepository, $this->em);

            $this->updateLaptopStatus->updateStatus($form, $this->laptopRepository, $this->em);
   
            $this->updateMonitorStatus->updateStatus($form, $this->monitorRepository, $this->em);
        
            $this->updateVideoprojectorStatus->updateStatus($form, $this->videoprojectorRepository, $this->em);
        
            $this->updateMouseStatus->updateStatus($form, $this->mouseRepository, $this->em);
        
            $this->updateKeyboardStatus->updateStatus($form, $this->keyboardRepository, $this->em);

        
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

             /** Manage status of all materials in submission of form with services */
          
             $this->updateComputerStatus->updateStatus($form, $this->computerRepository, $this->em);

             $this->updateLaptopStatus->updateStatus($form, $this->laptopRepository, $this->em);
         
             $this->updateMonitorStatus->updateStatus($form, $this->monitorRepository, $this->em);
         
             $this->updateVideoprojectorStatus->updateStatus($form, $this->videoprojectorRepository, $this->em);
         
             $this->updateMouseStatus->updateStatus($form, $this->mouseRepository, $this->em);
         
             $this->updateKeyboardStatus->updateStatus($form, $this->keyboardRepository, $this->em);
            
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
