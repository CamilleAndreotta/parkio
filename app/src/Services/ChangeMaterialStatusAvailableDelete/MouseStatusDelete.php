<?php 

namespace App\Services\ChangeMaterialStatusAvailableDelete;

use App\Repository\MouseRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class MouseStatusDelete{


public function updateStatus($id, InternalLocationRepository $internalLocationRepository, MouseRepository $mouseRepository, EntityManagerInterface $em ){
        
    $materialId = $internalLocationRepository->findMouseWithInternalLocationId($id);

    $materialToUpdate = $mouseRepository->find($materialId);

    if ($materialToUpdate != null) {
            $materialToUpdate->setStatus('Available');

            $em->persist($materialToUpdate);
    }

}


}