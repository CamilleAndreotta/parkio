<?php 

namespace App\Services\ChangeMaterialStatus;

use App\Repository\KeyboardRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class KeyboardStatus{


public function updateStatus($form, InternalLocationRepository $internalLocationRepository, KeyboardRepository $keyboardRepository, EntityManagerInterface $em ){

    $internalLocationId = $form->getData()->getId();

    if ($internalLocationId != null) {

        $materialId = $internalLocationRepository->findKeyboardWithInternalLocationId($internalLocationId);

        $materialToUpdate = $keyboardRepository->find($materialId);

        if ($materialToUpdate != null) {
            $materialToUpdate->setStatus('Available');

            $em->persist($materialToUpdate);
        }

        if ($form->getData()->getKeyboard() != null) {

            $keyboard= $form->getData()->getKeyboard();
    
            $keyboard->setStatus('Not Available');
    
            $em->persist($keyboard);
    
        }
        
    }

}





}