<?php 

namespace App\Services\ChangeMaterialStatusAvailableDelete;

use App\Repository\KeyboardRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class KeyboardStatusDelete{


public function updateStatus($id, InternalLocationRepository $internalLocationRepository, KeyboardRepository $keyboardRepository, EntityManagerInterface $em ){

    $materialId = $internalLocationRepository->findKeyboardWithInternalLocationId($id);

    $materialToUpdate = $keyboardRepository->find($materialId);

    if ($materialToUpdate != null) {
        $materialToUpdate->setStatus('Available');

        $em->persist($materialToUpdate);
    }


}





}