<?php 

namespace App\Services\ChangeMaterialStatus;

use App\Repository\LaptopRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class LaptopStatus{


public function updateStatus($form, InternalLocationRepository $internalLocationRepository, LaptopRepository $laptopRepository, EntityManagerInterface $em ){

    $internalLocationId = $form->getData()->getId();

    if ($internalLocationId != null) {

        $materialId = $internalLocationRepository->findLaptopWithInternalLocationId($internalLocationId);

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