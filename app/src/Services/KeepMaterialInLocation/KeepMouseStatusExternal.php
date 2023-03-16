<?php 

namespace App\Services\KeepMaterialInLocation;

use App\Repository\MouseRepository;
use App\Repository\ExternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class KeepMouseStatusExternal{


public function updateStatus($form, ExternalLocationRepository $externalLocationRepository, MouseRepository $mouseRepository, EntityManagerInterface $em ){

    $externalLocationId = $form->getData()->getId();

    if ($externalLocationId != null) {
        
        $materialId = $externalLocationRepository->findMouseWithExternalLocationId($externalLocationId);

        $materialToUpdate = $mouseRepository->find($materialId);

        if ($form->getData()->getMouse() === null) {
            $keepData = $externalLocationRepository->find($externalLocationId);
            $keepData->setMouse($materialToUpdate);

            $em->persist($keepData);
        }

    }


}





}