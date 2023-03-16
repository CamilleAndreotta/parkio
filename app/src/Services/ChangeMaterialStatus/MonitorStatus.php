<?php 

namespace App\Services\ChangeMaterialStatus;

use App\Repository\MonitorRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class MonitorStatus{


public function updateStatus($form, InternalLocationRepository $internalLocationRepository, MonitorRepository $monitorRepository, EntityManagerInterface $em ){

    $internalLocationId = $form->getData()->getId();

    if ($internalLocationId != null) {

        $materialId = $internalLocationRepository->findMonitorWithInternalLocationId($internalLocationId);

        $materialToUpdate = $monitorRepository->find($materialId);

        if ($materialToUpdate != null) {
            $materialToUpdate->setStatus('Available');

            $em->flush($materialToUpdate);
        }

        if ($form->getData()->getMonitor() != null) {

            $monitor = $form->getData()->getMonitor();
    
            $monitor->setStatus('Not Available');
    
            $em->persist($monitor);
    
            $em->flush();
        
        }
        
    }

   

}





}