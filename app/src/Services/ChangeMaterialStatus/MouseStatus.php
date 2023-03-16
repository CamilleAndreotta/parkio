<?php 

namespace App\Services\ChangeMaterialStatus;

use App\Repository\MouseRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class MouseStatus{


public function updateStatus($form, InternalLocationRepository $internalLocationRepository, MouseRepository $mouseRepository, EntityManagerInterface $em ){

    $internalLocationId = $form->getData()->getId();

    if ($internalLocationId != null) {
        
        $materialId = $internalLocationRepository->findMouseWithInternalLocationId($internalLocationId);

        $materialToUpdate = $mouseRepository->find($materialId);

        if ($materialToUpdate != null) {
            $materialToUpdate->setStatus('Available');

            $em->flush($materialToUpdate);
        }

        if ($form->getData()->getMouse() != null) {

            $mouse = $form->getData()->getMouse();
    
            $mouse->setStatus('Not Available');
    
            $em->persist($mouse);
    
            $em->flush();
        
        }

    }

    

}





}