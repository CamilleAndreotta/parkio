<?php 

namespace App\Services\KeepMaterialInLocation;

use App\Repository\LaptopRepository;
use App\Repository\ExternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class KeepLaptopStatusExternal{


public function updateStatus($form, ExternalLocationRepository $externalLocationRepository, LaptopRepository $laptopRepository, EntityManagerInterface $em ){

    $externalLocationId = $form->getData()->getId();

    if ($externalLocationId != null) {

        $materialId = $externalLocationRepository->findLaptopWithExternalLocationId($externalLocationId);

        $materialToUpdate = $laptopRepository->find($materialId);

        if ($form->getData()->getLaptop() === null) {
            $keepData = $externalLocationRepository->find($externalLocationId);
            $keepData->setLaptop($materialToUpdate);

            $em->persist($keepData);
        }
        
    }

}





}