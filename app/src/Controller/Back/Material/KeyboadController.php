<?php

namespace App\Controller\Back\Material;

use App\Entity\Keyboard;
use App\Form\KeyboardType;
use App\Repository\KeyboardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/material/keyboad")
 */
class KeyboadController extends AbstractController
{
    /**
     * @Route("/", name="app_back_material_keyboad_index", methods={"GET"})
     */
    public function index(KeyboardRepository $keyboardRepository): Response
    {
        return $this->render('back/material/keyboad/index.html.twig', [
            'keyboards' => $keyboardRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_back_material_keyboad_new", methods={"GET", "POST"})
     */
    public function new(Request $request, KeyboardRepository $keyboardRepository): Response
    {
        $keyboard = new Keyboard();
        $form = $this->createForm(KeyboardType::class, $keyboard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $keyboardRepository->add($keyboard, true);

            return $this->redirectToRoute('app_back_material_keyboad_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/material/keyboad/new.html.twig', [
            'keyboard' => $keyboard,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_material_keyboad_show", methods={"GET"})
     */
    public function show(Keyboard $keyboard): Response
    {
        return $this->render('back/material/keyboad/show.html.twig', [
            'keyboard' => $keyboard,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_back_material_keyboad_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Keyboard $keyboard, KeyboardRepository $keyboardRepository): Response
    {
        $form = $this->createForm(KeyboardType::class, $keyboard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $keyboardRepository->add($keyboard, true);

            return $this->redirectToRoute('app_back_material_keyboad_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/material/keyboad/edit.html.twig', [
            'keyboard' => $keyboard,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_material_keyboad_delete", methods={"POST"})
     */
    public function delete(Request $request, Keyboard $keyboard, KeyboardRepository $keyboardRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$keyboard->getId(), $request->request->get('_token'))) {
            $keyboardRepository->remove($keyboard, true);
        }

        return $this->redirectToRoute('app_back_material_keyboad_index', [], Response::HTTP_SEE_OTHER);
    }
}
