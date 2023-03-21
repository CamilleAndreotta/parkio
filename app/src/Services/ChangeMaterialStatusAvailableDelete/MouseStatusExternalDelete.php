<?php 

namespace App\Services\ChangeMaterialStatusAvailableDelete;

use App\Repository\MouseRepository;
use App\Repository\ExternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class MouseStatusExternalDelete{


public function updateStatus($id, ExternalLocationRepository $externalLocationRepository, MouseRepository $mouseRepository, EntityManagerInterface $em ){

        
    $materialId = $externalLocationRepository->findMouseWithExternalLocationId($id);

    $materialToUpdate = $mouseRepository->find($materialId);

    if ($materialToUpdate != null) {
            
        $materialToUpdate->setStatus('Available');

        $em->persist($materialToUpdate);
    }

}


}