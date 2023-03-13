<?php 

namespace App\Services\NotAvailable; 

use App\Entity\Mouse;
use App\Repository\InternalLocationRepository;
use App\Repository\MouseRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateMouseStatus{

    public function updateStatus($form, MouseRepository $mouseRepository, EntityManagerInterface $em ){

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