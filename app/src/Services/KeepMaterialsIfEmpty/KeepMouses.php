<?php 

namespace App\Services\KeepMaterialsIfEmpty;

use App\Repository\InternalLocationRepository;
use App\Repository\MouseRepository;
use Doctrine\ORM\EntityManagerInterface;

class KeepMouses{

    public function keepMaterial($form, InternalLocationRepository $internalLocationRepository, MouseRepository $mouseRepository, EntityManagerInterface $em){

        $idOfBill = $form->getData()->getId();
                
        $dataInDatabase = $internalLocationRepository->findInternalLocationWithMouse($idOfBill);

        foreach($dataInDatabase as $data){

            $id = $data['mouse_id'];

            $dataToKeep = $mouseRepository->find($id);

            $actualLocation = $internalLocationRepository->find($idOfBill);

            $actualLocation->addMouse($dataToKeep);

            $em->flush($actualLocation);
        }

    }


}