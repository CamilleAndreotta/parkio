<?php 

namespace App\Services\ChangeStatusNotAvailable; 

use App\Entity\Keyboard;
use App\Repository\InternalLocationRepository;
use App\Repository\KeyboardRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateKeyboardStatus{

    public function updateStatus($form, KeyboardRepository $keyboardRepository, InternalLocationRepository $internalLocationRepository, EntityManagerInterface $em ){

        $idOfBill = $form->getData()->getId();
                
        $dataInDatabase = $internalLocationRepository->findInternalLocationWithKeyboard($idOfBill);

        foreach($dataInDatabase as $data){

            $id = $data['keyboard_id'];

            $dataToChange = $keyboardRepository->find($id);

            $dataToChange->setStatus('available');

            $em->persist($dataToChange);

            $em->flush();

        }
        
        $datas = $form->getData()->getKeyboard();

        foreach($datas as $data){

            $id = $data->getId();

            $newData = $keyboardRepository->find($id);

            if($newData->getStatus() === 'available'){

            $newData->setStatus('notAvailable');

            $em->persist($newData);

            $em->flush();

            }

        }
    }

}