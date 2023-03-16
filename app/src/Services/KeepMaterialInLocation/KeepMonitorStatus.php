<?php 

namespace App\Services\KeepMaterialInLocation;

use App\Repository\MonitorRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class KeepMonitorStatus{


public function updateStatus($form, InternalLocationRepository $internalLocationRepository, MonitorRepository $monitorRepository, EntityManagerInterface $em ){

    $internalLocationId = $form->getData()->getId();

    if ($internalLocationId != null) {

        $materialId = $internalLocationRepository->findMonitorWithInternalLocationId($internalLocationId);

        $materialToUpdate = $monitorRepository->find($materialId);

        if ($form->getData()->getMonitor() === null) {
            $keepData = $internalLocationRepository->find($internalLocationId);
            $keepData->setMonitor($materialToUpdate);

            $em->persist($keepData);
        }

        
    }


}





}