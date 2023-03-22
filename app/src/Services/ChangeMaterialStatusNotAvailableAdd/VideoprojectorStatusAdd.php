<?php 

namespace App\Services\ChangeMaterialStatusNotAvailableAdd;

use App\Repository\VideoprojectorRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class VideoprojectorStatusAdd{


public function updateStatus($form, InternalLocationRepository $internalLocationRepository, VideoprojectorRepository $videoprojectorRepository, EntityManagerInterface $em ){

    $videoprojector= $form->getData()->getVideoprojector();
    
    $videoprojector->setStatus('Not Available');
    
    $em->persist($videoprojector);

}

}