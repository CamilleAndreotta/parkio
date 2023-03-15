<?php 

namespace App\Services\KeepMaterialsIfEmpty;

use App\Repository\InternalLocationRepository;
use App\Repository\MonitorRepository;
use Doctrine\ORM\EntityManagerInterface;

class KeepMonitors{

    public function keepMaterial($form, InternalLocationRepository $internalLocationRepository, MonitorRepository $monitorRepository, EntityManagerInterface $em){

        $idOfBill = $form->getData()->getId();
                
        $dataInDatabase = $internalLocationRepository->findInternalLocationWithMonitor($idOfBill);

        foreach($dataInDatabase as $data){

            $id = $data['monitor_id'];

            $dataToKeep = $monitorRepository->find($id);

            $actualLocation = $internalLocationRepository->find($idOfBill);

            $actualLocation->addMonitor($dataToKeep);

            $em->flush($actualLocation);
        }

    }


}