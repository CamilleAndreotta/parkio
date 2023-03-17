<?php 

namespace App\Services\ChangeMaterialStatus;

use App\Repository\LaptopRepository;
use App\Repository\ExternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class LaptopStatusExternal{


public function updateStatus($form, ExternalLocationRepository $externalLocationRepository, LaptopRepository $laptopRepository, EntityManagerInterface $em ){

    $externalLocationId = $form->getData()->getId();

    if ($externalLocationId != null) {

        $materialId = $externalLocationRepository->findLaptopWithExternalLocationId($externalLocationId);

        $materialToUpdate = $laptopRepository->find($materialId);

        if ($materialToUpdate != null) {
            
            $materialToUpdate->setStatus('Available');

            $em->persist($materialToUpdate);
        }

        if ($form->getData()->getLaptop() != null) {

            $laptop= $form->getData()->getLaptop();
    
            $laptop->setStatus('Not Available');
    
            $em->persist($laptop);
        
        }
        
    }

   

}





}