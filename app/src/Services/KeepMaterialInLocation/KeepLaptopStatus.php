<?php 

namespace App\Services\KeepMaterialInLocation;

use App\Repository\LaptopRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class KeepLaptopStatus{


public function updateStatus($form, InternalLocationRepository $internalLocationRepository, LaptopRepository $laptopRepository, EntityManagerInterface $em ){

    $internalLocationId = $form->getData()->getId();

    if ($internalLocationId != null) {

        $materialId = $internalLocationRepository->findLaptopWithInternalLocationId($internalLocationId);

        $materialToUpdate = $laptopRepository->find($materialId);

        if ($form->getData()->getLaptop() === null) {
            $keepData = $internalLocationRepository->find($internalLocationId);
            $keepData->setLaptop($materialToUpdate);

            $em->persist($keepData);
        }
        
    }

}





}