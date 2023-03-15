<?php 

namespace App\Services\KeepMaterialsIfEmpty;

use App\Repository\InternalLocationRepository;
use App\Repository\KeyboardRepository;
use Doctrine\ORM\EntityManagerInterface;

class KeepKeyboards{

    public function keepMaterial($form, InternalLocationRepository $internalLocationRepository, KeyboardRepository $keyboardRepository, EntityManagerInterface $em){

        $idOfBill = $form->getData()->getId();
                
        $dataInDatabase = $internalLocationRepository->findInternalLocationWithKeyboard($idOfBill);

        foreach($dataInDatabase as $data){

            $id = $data['keyboard_id'];

            $dataToKeep = $keyboardRepository->find($id);

            $actualLocation = $internalLocationRepository->find($idOfBill);

            $actualLocation->addKeyboard($dataToKeep);

            $em->flush($actualLocation);
            
        }

    }


}