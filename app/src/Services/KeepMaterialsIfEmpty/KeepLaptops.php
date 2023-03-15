<?php 

namespace App\Services\KeepMaterialsIfEmpty;

use App\Repository\InternalLocationRepository;
use App\Repository\LaptopRepository;
use Doctrine\ORM\EntityManagerInterface;

class KeepLaptops{

    public function keepMaterial($form, InternalLocationRepository $internalLocationRepository, LaptopRepository$laptopRepository, EntityManagerInterface $em){

        $idOfBill = $form->getData()->getId();
                
        $dataInDatabase = $internalLocationRepository->findInternalLocationWithLaptop($idOfBill);

        foreach($dataInDatabase as $data){

            $id = $data['laptop_id'];

            $dataToKeep = $laptopRepository->find($id);

            $actualLocation = $internalLocationRepository->find($idOfBill);

            $actualLocation->addLaptop($dataToKeep);

            $em->flush($actualLocation);
            
        }

    }


}