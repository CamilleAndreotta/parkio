<?php 

namespace App\Services\ChangeMaterialStatusNotAvailableAdd;

use App\Repository\MouseRepository;
use App\Repository\InternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class MouseStatusAdd{


public function updateStatus($form, InternalLocationRepository $internalLocationRepository, MouseRepository $mouseRepository, EntityManagerInterface $em ){

    $mouse = $form->getData()->getMouse();
    
    $mouse->setStatus('Not Available');
    
    $em->persist($mouse);
        
}


}