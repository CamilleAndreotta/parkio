<?php

namespace App\Controller\Back\Material;

use App\Entity\Mouse;
use App\Form\MouseType;
use App\Repository\InternalLocationRepository;
use App\Repository\MouseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/material/mouse")
 */
class MouseController extends AbstractController
{
    /**
     * @Route("/", name="app_back_material_mouse_index", methods={"GET"})
     */
    public function index(MouseRepository $mouseRepository): Response
    {
        return $this->render('back/material/mouse/index.html.twig', [
            'mice' => $mouseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_back_material_mouse_new", methods={"GET", "POST"})
     */
    public function new(Request $request, MouseRepository $mouseRepository, InternalLocationRepository $internalLocationRepository): Response
    {
        $mouse = new Mouse();
        $form = $this->createForm(MouseType::class, $mouse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $status =$form->getData()->getStatus();
            $id = $form->getData()->getId();

            if($status === "available"){

                $datas = $mouseRepository->findMouseAndInternalLocation($id);

                foreach($datas as $data){

                    $id = $data['internal_location_id'];

                    $newInternalLocation = $internalLocationRepository->find($id);

                    $newInternalLocation->removeMouse($mouse);
                    
                }

            }

            $mouseRepository->add($mouse, true);

            return $this->redirectToRoute('app_back_material_mouse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/material/mouse/new.html.twig', [
            'mouse' => $mouse,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_material_mouse_show", methods={"GET"})
     */
    public function show(Mouse $mouse): Response
    {
        return $this->render('back/material/mouse/show.html.twig', [
            'mouse' => $mouse,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_back_material_mouse_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Mouse $mouse, MouseRepository $mouseRepository): Response
    {
        $form = $this->createForm(MouseType::class, $mouse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mouseRepository->add($mouse, true);

            return $this->redirectToRoute('app_back_material_mouse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/material/mouse/edit.html.twig', [
            'mouse' => $mouse,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_material_mouse_delete", methods={"POST"})
     */
    public function delete(Request $request, Mouse $mouse, MouseRepository $mouseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mouse->getId(), $request->request->get('_token'))) {
            $mouseRepository->remove($mouse, true);
        }

        return $this->redirectToRoute('app_back_material_mouse_index', [], Response::HTTP_SEE_OTHER);
    }
}
