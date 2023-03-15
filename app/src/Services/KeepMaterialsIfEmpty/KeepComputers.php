<?php 

namespace App\Services\KeepMaterialsIfEmpty;

use App\Repository\ComputerRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

class KeepComputers{

    public function keepMaterial($form, InternalLocationRepository $internalLocationRepository, ComputerRepository $computerRepository, EntityManagerInterface $em){

        $idOfBill = $form->getData()->getId();
                
        $dataInDatabase = $internalLocationRepository->findInternalLocationWithComputer($idOfBill);

        foreach($dataInDatabase as $data){

            $id = $data['computer_id'];

            $dataToKeep = $computerRepository->find($id);

            $actualLocation = $internalLocationRepository->find($idOfBill);

            $actualLocation->addComputer($dataToKeep);

            $em->flush($actualLocation);

        }

    }


}