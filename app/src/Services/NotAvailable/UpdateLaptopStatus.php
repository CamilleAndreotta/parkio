<?php 

namespace App\Services\NotAvailable; 

use App\Entity\Laptop;
use App\Repository\InternalLocationRepository;
use App\Repository\LaptopRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateLaptopStatus{

    public function updateStatus($form, LaptopRepository $laptopRepository, EntityManagerInterface $em ){

        $datas = $form->getData()->getLaptop();

        foreach($datas as $data){

            $id = $data->getId();

            $newData = $laptopRepository->find($id);

            if($newData->getStatus() === 'available'){

            $newData->setStatus('notAvailable');

            $em->persist($newData);

            $em->flush();

            }

        }
    }

}