<?php 

namespace App\Services\ChangeMaterialStatusNotAvailableAdd;

use App\Repository\KeyboardRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class KeyboardStatusAdd{


public function updateStatus($form, InternalLocationRepository $internalLocationRepository, KeyboardRepository $keyboardRepository, EntityManagerInterface $em ){

    $keyboard= $form->getData()->getKeyboard();
    
    $keyboard->setStatus('Not Available');
    
    $em->persist($keyboard);

}


}