<?php 

namespace App\Services\ChangeStatusNotAvailable; 

use App\Entity\Mouse;
use App\Repository\InternalLocationRepository;
use App\Repository\MouseRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateMouseStatus{

    public function updateStatus($form, MouseRepository $mouseRepository, InternalLocationRepository $internalLocationRepository, EntityManagerInterface $em ){

        $idOfBill = $form->getData()->getId();
                
        $dataInDatabase = $internalLocationRepository->findInternalLocationWithMouse($idOfBill);

        foreach($dataInDatabase as $data){

            $id = $data['mouse_id'];

            $dataToChange = $mouseRepository->find($id);

            $dataToChange->setStatus('available');

            $em->persist($dataToChange);

            $em->flush();

        }

        $datas = $form->getData()->getMouse();

        foreach($datas as $data){

            $id = $data->getId();

            $newData = $mouseRepository->find($id);

            if($newData->getStatus() === 'available'){

            $newData->setStatus('notAvailable');

            $em->persist($newData);

            $em->flush();

            }

        }
    }

}