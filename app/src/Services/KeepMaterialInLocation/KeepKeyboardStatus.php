<?php 

namespace App\Services\KeepMaterialInLocation;

use App\Repository\KeyboardRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class KeepKeyboardStatus{


public function updateStatus($form, InternalLocationRepository $internalLocationRepository, KeyboardRepository $keyboardRepository, EntityManagerInterface $em ){

    $internalLocationId = $form->getData()->getId();

    if ($internalLocationId != null) {

        $materialId = $internalLocationRepository->findKeyboardWithInternalLocationId($internalLocationId);

        $materialToUpdate = $keyboardRepository->find($materialId);

        if ($form->getData()->getKeyboard() === null) {
            $keepData = $internalLocationRepository->find($internalLocationId);
            $keepData->setKeyboard($materialToUpdate);

            $em->persist($keepData);
        }

    }


}





}