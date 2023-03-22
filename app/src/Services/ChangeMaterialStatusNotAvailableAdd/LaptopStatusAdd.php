<?php 

namespace App\Services\ChangeMaterialStatusNotAvailableAdd;

use App\Repository\LaptopRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class LaptopStatusAdd{


public function updateStatus($form, InternalLocationRepository $internalLocationRepository, LaptopRepository $laptopRepository, EntityManagerInterface $em ){

    $laptop= $form->getData()->getLaptop();
    
    $laptop->setStatus('Not Available');
    
    $em->persist($laptop);
        
}


}