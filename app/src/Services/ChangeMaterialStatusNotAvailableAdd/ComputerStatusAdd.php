<?php 

namespace App\Services\ChangeMaterialStatusNotAvailableAdd;

use App\Repository\ComputerRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class ComputerStatusAdd{


public function updateStatus($form, InternalLocationRepository $internalLocationRepository, ComputerRepository $computerRepository, EntityManagerInterface $em ){

    $computer= $form->getData()->getComputer();
    
    $computer->setStatus('Not Available');
    
    $em->persist($computer);
        
}


}