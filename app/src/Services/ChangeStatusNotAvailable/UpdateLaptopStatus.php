<?php 

namespace App\Services\ChangeStatusNotAvailable; 

use App\Entity\Laptop;
use App\Repository\InternalLocationRepository;
use App\Repository\LaptopRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateLaptopStatus{

    public function updateStatus($form, LaptopRepository $laptopRepository, InternalLocationRepository $internalLocationRepository, EntityManagerInterface $em ){

        $idOfBill = $form->getData()->getId();
                
        $dataInDatabase = $internalLocationRepository->findInternalLocationWithLaptop($idOfBill);

        
        foreach($dataInDatabase as $data){

            $id = $data['laptop_id'];

            $dataToChange = $laptopRepository->find($id);

            $dataToChange->setStatus('available');

            $em->persist($dataToChange);

            $em->flush();

        }

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