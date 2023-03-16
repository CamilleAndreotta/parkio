<?php

namespace App\Controller\Back\Material;

use App\Entity\Keyboard;
use App\Form\KeyboardType;
use App\Repository\InternalLocationRepository;
use App\Repository\KeyboardRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/material/keyboard")
 */
class KeyboardController extends AbstractController
{
    /**
     * @Route("/", name="app_back_material_keyboard_index", methods={"GET"})
     */
    public function index(KeyboardRepository $keyboardRepository): Response
    {
        return $this->render('back/material/keyboard/index.html.twig', [
            'keyboards' => $keyboardRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_back_material_keyboard_new", methods={"GET", "POST"})
     */
    public function new(Request $request, KeyboardRepository $keyboardRepository): Response
    {
        $keyboard = new Keyboard();
        $form = $this->createForm(KeyboardType::class, $keyboard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $keyboardRepository->add($keyboard, true);

            return $this->redirectToRoute('app_back_material_keyboard_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/material/keyboard/new.html.twig', [
            'keyboard' => $keyboard,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_material_keyboard_show", methods={"GET"})
     */
    public function show(Keyboard $keyboard): Response
    {
        return $this->render('back/material/keyboard/show.html.twig', [
            'keyboard' => $keyboard,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_back_material_keyboard_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Keyboard $keyboard, KeyboardRepository $keyboardRepository, InternalLocationRepository $internalLocationRepository, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(KeyboardType::class, $keyboard);
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $status =$form->getData()->getStatus();

                $id = $form->getData()->getId();

                if($status === "Available"){

                $datas = $keyboardRepository->findKeyboardAndInternalLocation($id);

                foreach($datas as $data){

                    $idLocation = $data['id'];

                    $idMaterial = $data['keyboard_id'];

                    $statusToUpdate = $keyboardRepository->find($idMaterial);

                    $statusToUpdate->setStatus('Available');
                
                    $em->flush($statusToUpdate);


                    $newInternalLocation = $internalLocationRepository->find($idLocation);

                    $newInternalLocation->setKeyboard( NULL );

                    $em->flush($newInternalLocation);
                    
                }

            }

            $keyboardRepository->add($keyboard, true);

            return $this->redirectToRoute('app_back_material_keyboard_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/material/keyboard/edit.html.twig', [
            'keyboard' => $keyboard,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_material_keyboard_delete", methods={"POST"})
     */
    public function delete(Request $request, Keyboard $keyboard, KeyboardRepository $keyboardRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$keyboard->getId(), $request->request->get('_token'))) {
            $keyboardRepository->remove($keyboard, true);
        }

        return $this->redirectToRoute('app_back_material_keyboard_index', [], Response::HTTP_SEE_OTHER);
    }
}
