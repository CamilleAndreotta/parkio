<?php 

namespace App\Services\ChangeMaterialStatusAvailableDelete;

use App\Repository\LaptopRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class LaptopStatusDelete{


public function updateStatus($id, InternalLocationRepository $internalLocationRepository, LaptopRepository $laptopRepository, EntityManagerInterface $em ){

    $materialId = $internalLocationRepository->findLaptopWithInternalLocationId($id);

    $materialToUpdate = $laptopRepository->find($materialId);

    if ($materialToUpdate != null) {
        $materialToUpdate->setStatus('Available');

        $em->persist($materialToUpdate);
    }

}





}