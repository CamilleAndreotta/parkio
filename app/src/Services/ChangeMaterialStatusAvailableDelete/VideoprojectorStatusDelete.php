<?php 

namespace App\Services\ChangeMaterialStatusAvailableDelete;

use App\Repository\VideoprojectorRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class VideoprojectorStatusDelete{


public function updateStatus($id, InternalLocationRepository $internalLocationRepository, VideoprojectorRepository $videoprojectorRepository, EntityManagerInterface $em ){

    $materialId = $internalLocationRepository->findVideoprojectorWithInternalLocationId($id);

    $materialToUpdate = $videoprojectorRepository->find($materialId);

    if ($materialToUpdate != null) {
        $materialToUpdate->setStatus('Available');

        $em->persist($materialToUpdate);
    }


}


}