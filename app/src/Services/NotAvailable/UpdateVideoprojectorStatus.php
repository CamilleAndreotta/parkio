<?php 

namespace App\Services\NotAvailable; 

use App\Entity\Videoprojector;
use App\Repository\InternalLocationRepository;
use App\Repository\VideoprojectorRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateVideoprojectorStatus{

    public function updateStatus($form, VideoprojectorRepository $videoprojectorRepository, EntityManagerInterface $em ){

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