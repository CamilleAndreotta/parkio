<?php

namespace App\Controller\Back\Material;

use App\Entity\Mouse;
use App\Form\MouseType;
use App\Repository\ExternalLocationRepository;
use App\Repository\InternalLocationRepository;
use App\Repository\MouseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_ADMIN")
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
    public function edit(Request $request, Mouse $mouse, MouseRepository $mouseRepository, InternalLocationRepository $internalLocationRepository, ExternalLocationRepository $externalLocationRepository, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(MouseType::class, $mouse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $status =$form->getData()->getStatus();

            $affectation = $form->getData()->getAffectation();

            $id = $form->getData()->getId();

            if ($status === "Available"&& $affectation === 'Interne' ) {

                $datas = $mouseRepository->findMouseAndInternalLocation($id);

                foreach ($datas as $data) {
                    $idLocation = $data['id'];

                    $idMaterial = $data['mouse_id'];

                    $statusToUpdate = $mouseRepository->find($idMaterial);

                    $statusToUpdate->setStatus('Available');

                    $em->flush($statusToUpdate);


                    $newInternalLocation = $internalLocationRepository->find($idLocation);

                    $newInternalLocation->setMouse(null);

                    $em->flush($newInternalLocation);

                }
                    
            }

            if ($status === "Available"&& $affectation === 'Externe' ) {

                $datas = $mouseRepository->findMouseAndExternalLocation($id);

                foreach ($datas as $data) {

                    $idLocation = $data['id'];

                    $idMaterial = $data['mouse_id'];

                    $statusToUpdate = $mouseRepository->find($idMaterial);

                    $statusToUpdate->setStatus('Available');

                    $em->flush($statusToUpdate);


                    $newExternalLocation = $externalLocationRepository->find($idLocation);

                    $newExternalLocation->setMouse(null);

                    $em->flush($newExternalLocation);

                }
                    
            }

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
