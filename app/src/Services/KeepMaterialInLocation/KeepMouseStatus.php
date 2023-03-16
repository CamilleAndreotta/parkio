<?php 

namespace App\Services\KeepMaterialInLocation;

use App\Repository\MouseRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class KeepMouseStatus{


public function updateStatus($form, InternalLocationRepository $internalLocationRepository, MouseRepository $mouseRepository, EntityManagerInterface $em ){

    $internalLocationId = $form->getData()->getId();

    if ($internalLocationId != null) {
        
        $materialId = $internalLocationRepository->findMouseWithInternalLocationId($internalLocationId);

        $materialToUpdate = $mouseRepository->find($materialId);

        if ($form->getData()->getMouse() === null) {
            $keepData = $internalLocationRepository->find($internalLocationId);
            $keepData->setMouse($materialToUpdate);

            $em->persist($keepData);
        }

    }


}





}