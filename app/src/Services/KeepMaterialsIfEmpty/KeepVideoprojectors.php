<?php 

namespace App\Services\KeepMaterialsIfEmpty;

use App\Repository\InternalLocationRepository;
use App\Repository\VideoprojectorRepository;
use Doctrine\ORM\EntityManagerInterface;

class KeepVideoprojectors{

    public function keepMaterial($form, InternalLocationRepository $internalLocationRepository, VideoprojectorRepository $videoprojectorRepository, EntityManagerInterface $em){

        $idOfBill = $form->getData()->getId();
                
        $dataInDatabase = $internalLocationRepository->findInternalLocationWithVideoprojector($idOfBill);

        foreach($dataInDatabase as $data){

            $id = $data['videoprojector_id'];

            $dataToKeep = $videoprojectorRepository->find($id);

            $actualLocation = $internalLocationRepository->find($idOfBill);

            $actualLocation->addVideoprojector($dataToKeep);

            $em->flush($actualLocation);
        }

    }


}