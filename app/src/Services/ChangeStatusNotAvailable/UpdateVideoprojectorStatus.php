<?php 

namespace App\Services\ChangeStatusNotAvailable; 

use App\Entity\Videoprojector;
use App\Repository\InternalLocationRepository;
use App\Repository\VideoprojectorRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateVideoprojectorStatus{

    public function updateStatus($form, VideoprojectorRepository $videoprojectorRepository, InternalLocationRepository $internalLocationRepository, EntityManagerInterface $em ){

        $idOfBill = $form->getData()->getId();
                
        $dataInDatabase = $internalLocationRepository->findInternalLocationWithVideoprojector($idOfBill);

        foreach($dataInDatabase as $data){

            $id = $data['videoprojector_id'];

            $dataToChange = $videoprojectorRepository->find($id);

            $dataToChange->setStatus('available');

            $em->persist($dataToChange);

            $em->flush();

        }

        $datas = $form->getData()->getVideoprojector();

        foreach($datas as $data){

            $id = $data->getId();

            $newData = $videoprojectorRepository->find($id);

            if($newData->getStatus() === 'available'){

            $newData->setStatus('notAvailable');

            $em->persist($newData);

            $em->flush();

            }

        }
    }

}