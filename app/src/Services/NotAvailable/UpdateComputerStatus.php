<?php 

namespace App\Services\NotAvailable; 

use App\Entity\Computer; 
use App\Repository\ComputerRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateComputerStatus{

    public function updateStatus($form, ComputerRepository $computerRepository, EntityManagerInterface $em ){

        $datas = $form->getData()->getComputer();
        
        foreach($datas as $data){

            $id = $data->getId();

            $newData = $computerRepository->find($id);

            if($newData->getStatus() === 'available'){

            $newData->setStatus('notAvailable');

            $em->persist($newData);

            $em->flush();

            }

        }
    }

}