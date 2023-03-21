<?php 

namespace App\Services\ChangeMaterialStatusAvailableDelete;

use App\Repository\LaptopRepository;
use App\Repository\ExternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class LaptopStatusExternalDelete{


public function updateStatus($id, ExternalLocationRepository $externalLocationRepository, LaptopRepository $laptopRepository, EntityManagerInterface $em ){

    $materialId = $externalLocationRepository->findLaptopWithExternalLocationId($id);

    $materialToUpdate = $laptopRepository->find($materialId);

    if ($materialToUpdate != null) {
            
        $materialToUpdate->setStatus('Available');

        $em->persist($materialToUpdate);
    }


}


}