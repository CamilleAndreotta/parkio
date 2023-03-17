<?php 

namespace App\Services\ChangeMaterialStatus;

use App\Repository\VideoprojectorRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class VideoprojectorStatus{


public function updateStatus($form, InternalLocationRepository $internalLocationRepository, VideoprojectorRepository $videoprojectorRepository, EntityManagerInterface $em ){

    $internalLocationId = $form->getData()->getId();

    if ($internalLocationId != null) {

        $materialId = $internalLocationRepository->findVideoprojectorWithInternalLocationId($internalLocationId);

        $materialToUpdate = $videoprojectorRepository->find($materialId);

        if ($materialToUpdate != null) {
            $materialToUpdate->setStatus('Available');

            $em->persist($materialToUpdate);
        }

        if ($form->getData()->getVideoprojector() != null) {

            $videoprojector= $form->getData()->getVideoprojector();
    
            $videoprojector->setStatus('Not Available');
    
            $em->persist($videoprojector);
        
        }
        
    }

}





}