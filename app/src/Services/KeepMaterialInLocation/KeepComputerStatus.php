<?php 

namespace App\Services\KeepMaterialInLocation;

use App\Repository\ComputerRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class KeepComputerStatus{


public function updateStatus($form, InternalLocationRepository $internalLocationRepository, ComputerRepository $computerRepository, EntityManagerInterface $em ){


    $internalLocationId = $form->getData()->getId();

    if ($internalLocationId != null) {
        $materialId = $internalLocationRepository->findComputerWithInternalLocationId($internalLocationId);

        $materialToUpdate = $computerRepository->find($materialId);

        if ($form->getData()->getComputer() === null) {
            $keepData = $internalLocationRepository->find($internalLocationId);
            $keepData->setComputer($materialToUpdate);

            $em->persist($keepData);
        }

        
    }



}





}