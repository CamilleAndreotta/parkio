<?php 

namespace App\Services\ChangeStatusNotAvailable; 

use App\Entity\Computer; 
use App\Repository\ComputerRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateComputerStatus{

    public function updateStatus($form, ComputerRepository $computerRepository, InternalLocationRepository $internalLocationRepository, EntityManagerInterface $em ){

        $idOfBill = $form->getData()->getId();
                
        $dataInDatabase = $internalLocationRepository->findInternalLocationWithComputer($idOfBill);

        foreach($dataInDatabase as $data){

            $id = $data['computer_id'];

            $dataToChange = $computerRepository->find($id);

            $dataToChange->setStatus('available');

            $em->persist($dataToChange);

            $em->flush();

        }

        $datas = $form->getData()->getComputer();
        
        foreach($datas as $data){

            $id = $data->getId();

            $newData = $computerRepository->find($id);

            if($newData->getStatus() === 'available'){

            $newData->setStatus('notAvailable');

            $em->flush();

            }

        }

       
    }

}