<?php 

namespace App\Services\ChangeMaterialStatusAvailableDelete;

use App\Repository\ComputerRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class ComputerStatusDelete{

public function updateStatus($id, InternalLocationRepository $internalLocationRepository, ComputerRepository $computerRepository, EntityManagerInterface $em ){

    $materialId = $internalLocationRepository->findComputerWithInternalLocationId($id);

    $materialToUpdate = $computerRepository->find($materialId);

    if ($materialToUpdate != null) {
        $materialToUpdate->setStatus('Available');

        $em->persist($materialToUpdate);
    }

    
}


}