<?php 

namespace App\Services\NotAvailable; 

use App\Entity\Monitor;
use App\Repository\InternalLocationRepository;
use App\Repository\MonitorRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateMonitorStatus{

    public function updateStatus($form, MonitorRepository $monitorRepository, EntityManagerInterface $em ){

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