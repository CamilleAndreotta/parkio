<?php 

namespace App\Services\ChangeMaterialStatus;

use App\Repository\ComputerRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class ComputerStatus{


public function updateStatus($form, InternalLocationRepository $internalLocationRepository, ComputerRepository $computerRepository, EntityManagerInterface $em ){


    $internalLocationId = $form->getData()->getId();

    if ($internalLocationId != null) {
        $materialId = $internalLocationRepository->findComputerWithInternalLocationId($internalLocationId);

        $materialToUpdate = $computerRepository->find($materialId);

        if ($materialToUpdate != null) {
            $materialToUpdate->setStatus('Available');

            $em->persist($materialToUpdate);
        }

        if ($form->getData()->getComputer() != null) {

            $computer= $form->getData()->getComputer();
    
            $computer->setStatus('Not Available');
    
            $em->persist($computer);
        
        }
    }

    

}





}