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

use App\Services\ChangeMaterialStatus\ComputerStatus;
use App\Services\ChangeMaterialStatus\KeyboardStatus;
use App\Services\ChangeMaterialStatus\LaptopStatus;
use App\Services\ChangeMaterialStatus\MonitorStatus;
use App\Services\ChangeMaterialStatus\MouseStatus;
use App\Services\ChangeMaterialStatus\VideoprojectorStatus;
use App\Services\ChangeMaterialStatusAvailableDelete\ComputerStatusDelete;
use App\Services\ChangeMaterialStatusAvailableDelete\KeyboardStatusDelete;
use App\Services\ChangeMaterialStatusAvailableDelete\LaptopStatusDelete;
use App\Services\ChangeMaterialStatusAvailableDelete\MonitorStatusDelete;
use App\Services\ChangeMaterialStatusAvailableDelete\MouseStatusDelete;
use App\Services\ChangeMaterialStatusAvailableDelete\VideoprojectorStatusDelete;
use App\Services\KeepMaterialInLocation\KeepComputerStatus;
use App\Services\KeepMaterialInLocation\KeepKeyboardStatus;
use App\Services\KeepMaterialInLocation\KeepLaptopStatus;
use App\Services\KeepMaterialInLocation\KeepMonitorStatus;
use App\Services\KeepMaterialInLocation\KeepMouseStatus;
use App\Services\KeepMaterialInLocation\KeepVideoprojectorStatus;

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

    private $computerStatus;
    private $keyboardStatus;
    private $laptopStatus;
    private $monitorStatus;
    private $mouseStatus;
    private $videoprojectorStatus;

    private $keepComputerStatus;
    private $keepKeyboardStatus;
    private $keepLaptopStatus;
    private $keepMonitorStatus;
    private $keepMouseStatus;
    private $keepVideoprojectorStatus;

    private $computerStatusDelete;
    private $keyboardStatusDelete;
    private $laptopStatusDelete;
    private $monitorStatusDelete;
    private $mouseStatusDelete;
    private $videoprojectorStatusDelete;

    private $em; 


    public function __construct(
        
        LaptopRepository $laptopRepository, 
        ComputerRepository $computerRepository, 
        MonitorRepository $monitorRepository, 
        VideoprojectorRepository $videoprojectorRepository, 
        MouseRepository $mouseRepository, 
        KeyboardRepository $keyboardRepository, 
        InternalLocationRepository $internalLocationRepository,

        ComputerStatus $computerStatus,
        KeyboardStatus $keyboardStatus,
        LaptopStatus $laptopStatus,
        MonitorStatus $monitorStatus,
        MouseStatus $mouseStatus,
        VideoprojectorStatus $videoprojectorStatus,

        KeepComputerStatus $keepComputerStatus,
        KeepKeyboardStatus $keepKeyboardStatus,
        KeepLaptopStatus $keepLaptopStatus,
        KeepMonitorStatus $keepMonitorStatus,
        KeepMouseStatus $keepMouseStatus,
        KeepVideoprojectorStatus $keepVideoprojectorStatus,

        ComputerStatusDelete $computerStatusDelete,
        LaptopStatusDelete $laptopStatusDelete,
        MonitorStatusDelete $monitorStatusDelete,
        VideoprojectorStatusDelete $videoprojectorStatusDelete,
        MouseStatusDelete $mouseStatusDelete,
        KeyboardStatusDelete $keyboardStatusDelete,

        EntityManagerInterface $em 
        
        ){

        $this->laptopRepository =  $laptopRepository; 
        $this->computerRepository = $computerRepository;
        $this->monitorRepository = $monitorRepository; 
        $this->mouseRepository = $mouseRepository; 
        $this->videoprojectorRepository = $videoprojectorRepository; 
        $this->keyboardRepository = $keyboardRepository;
        $this->internalLocationRepository = $internalLocationRepository;

        $this->computerStatus = $computerStatus; 
        $this->keyboardStatus = $keyboardStatus;
        $this->laptopStatus = $laptopStatus;
        $this->monitorStatus = $monitorStatus;
        $this->mouseStatus = $mouseStatus; 
        $this->videoprojectorStatus =$videoprojectorStatus;

        $this->keepComputerStatus = $keepComputerStatus;
        $this->keepKeyboardStatus = $keepKeyboardStatus;
        $this->keepLaptopStatus = $keepLaptopStatus;
        $this->keepMonitorStatus = $keepMonitorStatus; 
        $this->keepMouseStatus = $keepMouseStatus; 
        $this->keepVideoprojectorStatus = $keepVideoprojectorStatus;
        
        $this->computerStatusDelete = $computerStatusDelete; 
        $this->keyboardStatusDelete = $keyboardStatusDelete;
        $this->laptopStatusDelete = $laptopStatusDelete;
        $this->monitorStatusDelete = $monitorStatusDelete;
        $this->mouseStatusDelete = $mouseStatusDelete; 
        $this->videoprojectorStatusDelete =$videoprojectorStatusDelete;

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

            $this->computerStatus->updateStatus($form, $this->internalLocationRepository, $this->computerRepository, $this->em);
        
            $this->laptopStatus->updateStatus($form, $this->internalLocationRepository, $this->laptopRepository, $this->em);

            $this->monitorStatus->updateStatus($form, $this->internalLocationRepository, $this->monitorRepository, $this->em);

            $this->videoprojectorStatus->updateStatus($form, $this->internalLocationRepository, $this->videoprojectorRepository, $this->em);

            $this->mouseStatus->updateStatus($form, $this->internalLocationRepository, $this->mouseRepository, $this->em);

            $this->keyboardStatus->updateStatus($form, $this->internalLocationRepository, $this->keyboardRepository, $this->em);

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

        $id = $form->getData()->getId();

        if ($form->isSubmitted() && $form->isValid()) {

            if($form->getData()->getComputer() !== null ){

                $this->computerStatus->updateStatus($form, $this->internalLocationRepository, $this->computerRepository, $this->em);

            } else {

                $this->keepComputerStatus->updateStatus($form, $this->internalLocationRepository, $this->computerRepository, $this->em);

            }

            if ($form->getData()->getLaptop() !== null) {

                $this->laptopStatus->updateStatus($form, $this->internalLocationRepository, $this->laptopRepository, $this->em);

            } else {

                $this->keepLaptopStatus->updateStatus($form, $this->internalLocationRepository, $this->laptopRepository, $this->em);

            }

            if ($form->getData()->getMonitor() !== null) {

                $this->monitorStatus->updateStatus($form, $this->internalLocationRepository, $this->monitorRepository, $this->em);

            } else {

                $this->keepMonitorStatus->updateStatus($form, $this->internalLocationRepository, $this->monitorRepository, $this->em);

            }
            
            if ($form->getData()->getVideoprojector() !== null) {

                $this->videoprojectorStatus->updateStatus($form, $this->internalLocationRepository, $this->videoprojectorRepository, $this->em);

            } else {

                $this->keepVideoprojectorStatus->updateStatus($form, $this->internalLocationRepository, $this->videoprojectorRepository, $this->em);

            }

            if ($form->getData()->getMouse() !== null) {

                $this->mouseStatus->updateStatus($form, $this->internalLocationRepository, $this->mouseRepository, $this->em);

            } else {

                $this->keepMouseStatus->updateStatus($form, $this->internalLocationRepository, $this->mouseRepository, $this->em);

            }

            if ($form->getData()->getKeyboard() !== null) {

                $this->keyboardStatus->updateStatus($form, $this->internalLocationRepository, $this->keyboardRepository, $this->em);

            } else {

                $this->keepKeyboardStatus->updateStatus($form, $this->internalLocationRepository, $this->keyboardRepository, $this->em);

            }

            $internalLocationRepository->add($internalLocation, true);
            
            return $this->redirectToRoute('app_back_internal_location_index', [], Response::HTTP_SEE_OTHER);
            
        }

        return $this->renderForm('back/internal_location/edit.html.twig', [
            
            'internal_location' => $internalLocation,
            'form' => $form,
            'laptop' => $internalLocationRepository->find($id)->getLaptop(),
            'computer' => $internalLocationRepository->find($id)->getComputer(),
            'monitor' => $internalLocationRepository->find($id)->getMonitor(),
            'videoprojector' => $internalLocationRepository->find($id)->getVideoprojector(),
            'mouse' => $internalLocationRepository->find($id)->getMouse(),
            'keyboard' => $internalLocationRepository->find($id)->getKeyboard(),

        ]);
    }

    /**
     * @Route("/{id}", name="app_back_internal_location_delete", methods={"POST"})
     */
    public function delete(Request $request, InternalLocation $internalLocation, InternalLocationRepository $internalLocationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$internalLocation->getId(), $request->request->get('_token'))) {

            $id = $internalLocation->getId();

            if($id !== null){
                $this->computerStatusDelete->updateStatus($id, $this->internalLocationRepository, $this->computerRepository, $this->em);
            }

            if($id != null){
                $this->laptopStatusDelete->updateStatus($id, $this->internalLocationRepository, $this->laptopRepository, $this->em);
            }

            if($id != null){
                $this->monitorStatusDelete->updateStatus($id, $this->internalLocationRepository, $this->monitorRepository, $this->em);
            }

            if($id != null){
                $this->videoprojectorStatusDelete->updateStatus($id, $this->internalLocationRepository, $this->videoprojectorRepository, $this->em);
            }

            if($id != null){
                $this->keyboardStatusDelete->updateStatus($id, $this->internalLocationRepository, $this->keyboardRepository, $this->em);
            }

            if($id != null){
                $this->mouseStatusDelete->updateStatus($id, $this->internalLocationRepository, $this->mouseRepository, $this->em);
            }
            

            $internalLocationRepository->remove($internalLocation, true);
        }

        return $this->redirectToRoute('app_back_internal_location_index', [], Response::HTTP_SEE_OTHER);
    }
}
