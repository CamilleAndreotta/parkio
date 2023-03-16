<?php 

namespace App\Services\ChangeMaterialStatus;

use App\Repository\MouseRepository;
use App\Repository\ExternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class MouseStatusExternal{


public function updateStatus($form, ExternalLocationRepository $externalLocationRepository, MouseRepository $mouseRepository, EntityManagerInterface $em ){

    $externalLocationId = $form->getData()->getId();

    if ($externalLocationId != null) {
        
        $materialId = $externalLocationRepository->findMouseWithExternalLocationId($externalLocationId);

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