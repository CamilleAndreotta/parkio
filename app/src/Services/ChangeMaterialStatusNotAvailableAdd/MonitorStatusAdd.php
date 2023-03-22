<?php 

namespace App\Services\ChangeMaterialStatusNotAvailableAdd;

use App\Repository\MonitorRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class MonitorStatusAdd{


public function updateStatus($form, InternalLocationRepository $internalLocationRepository, MonitorRepository $monitorRepository, EntityManagerInterface $em ){

    $monitor = $form->getData()->getMonitor();
    
    $monitor->setStatus('Not Available');
    
    $em->persist($monitor);
    

}


}