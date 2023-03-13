<?php 

namespace App\Services\NotAvailable; 

use App\Entity\Keyboard;
use App\Repository\InternalLocationRepository;
use App\Repository\KeyboardRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateKeyboardStatus{

    public function updateStatus($form, KeyboardRepository $keyboardRepository, EntityManagerInterface $em ){

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