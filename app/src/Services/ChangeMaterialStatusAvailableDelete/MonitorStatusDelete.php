<?php 

namespace App\Services\ChangeMaterialStatusAvailableDelete;

use App\Repository\MonitorRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class MonitorStatusDelete{


public function updateStatus($id, InternalLocationRepository $internalLocationRepository, MonitorRepository $monitorRepository, EntityManagerInterface $em ){

    $materialId = $internalLocationRepository->findMonitorWithInternalLocationId($id);

    $materialToUpdate = $monitorRepository->find($materialId);

    if ($materialToUpdate != null) {
        $materialToUpdate->setStatus('Available');

        $em->persist($materialToUpdate);
    }

}

}