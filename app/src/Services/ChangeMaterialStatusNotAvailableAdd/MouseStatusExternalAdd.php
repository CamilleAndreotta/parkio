<?php 

namespace App\Services\ChangeMaterialStatusNotAvailableAdd;

use App\Repository\MouseRepository;
use App\Repository\ExternalLocationRepository;
use Doctrine\ORM\EntityManagerInterface;

Class MouseStatusExternalAdd{


public function updateStatus($form, ExternalLocationRepository $externalLocationRepository, MouseRepository $mouseRepository, EntityManagerInterface $em ){

    $mouse = $form->getData()->getMouse();
    
    $mouse->setStatus('Not Available');
    
    $em->persist($mouse);
    
}


}