<?php 

namespace App\Services\ChangeStatusNotAvailable; 

use App\Entity\Monitor;
use App\Repository\InternalLocationRepository;
use App\Repository\MonitorRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateMonitorStatus{

    public function updateStatus($form, MonitorRepository $monitorRepository, InternalLocationRepository $internalLocationRepository, EntityManagerInterface $em ){

        $idOfBill = $form->getData()->getId();
                
        $dataInDatabase = $internalLocationRepository->findInternalLocationWithMonitor($idOfBill);

        foreach($dataInDatabase as $data){

            $id = $data['monitor_id'];

            $dataToChange = $monitorRepository->find($id);

            $dataToChange->setStatus('available');

            $em->persist($dataToChange);

            $em->flush();

        }

        $datas = $form->getData()->getMonitor();

        foreach($datas as $data){

            $id = $data->getId();

            $newData = $monitorRepository->find($id);

            if($newData->getStatus() === 'available'){

            $newData->setStatus('notAvailable');

            $em->persist($newData);

            $em->flush();

            }

        }
    }

}