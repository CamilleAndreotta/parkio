<?php 

namespace App\Services\KeepMaterialInLocation;

use App\Repository\VideoprojectorRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class KeepVideoprojectorStatus{


public function updateStatus($form, InternalLocationRepository $internalLocationRepository, VideoprojectorRepository $videoprojectorRepository, EntityManagerInterface $em ){

    $internalLocationId = $form->getData()->getId();

    if ($internalLocationId != null) {

        $materialId = $internalLocationRepository->findVideoprojectorWithInternalLocationId($internalLocationId);

        $materialToUpdate = $videoprojectorRepository->find($materialId);

        if ($form->getData()->getVideoprojector() === null) {
            $keepData = $internalLocationRepository->find($internalLocationId);
            $keepData->setVideoprojector($materialToUpdate);

            $em->persist($keepData);
        }
        
    }

}





}