<?php 

namespace App\Services\ChangeMaterialStatusNotAvailableAdd;

use App\Repository\LaptopRepository;
use App\Repository\ExternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class LaptopStatusExternalAdd{


public function updateStatus($form, ExternalLocationRepository $externalLocationRepository, LaptopRepository $laptopRepository, EntityManagerInterface $em ){

    $laptop= $form->getData()->getLaptop();
    
    $laptop->setStatus('Not Available');
    
    $em->persist($laptop);

}


}