<?php

namespace App\Controller\Back\Material;

use App\Entity\Videoprojector;
use App\Form\VideoprojectorType;
use App\Repository\InternalLocationRepository;
use App\Repository\VideoprojectorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/material/videoprojector")
 */
class VideoprojectorController extends AbstractController
{
    /**
     * @Route("/", name="app_back_material_videoprojector_index", methods={"GET"})
     */
    public function index(VideoprojectorRepository $videoprojectorRepository): Response
    {
        return $this->render('back/material/videoprojector/index.html.twig', [
            'videoprojectors' => $videoprojectorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_back_material_videoprojector_new", methods={"GET", "POST"})
     */
    public function new(Request $request, VideoprojectorRepository $videoprojectorRepository): Response
    {
        $videoprojector = new Videoprojector();
        $form = $this->createForm(VideoprojectorType::class, $videoprojector);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $videoprojectorRepository->add($videoprojector, true);

            return $this->redirectToRoute('app_back_material_videoprojector_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/material/videoprojector/new.html.twig', [
            'videoprojector' => $videoprojector,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_material_videoprojector_show", methods={"GET"})
     */
    public function show(Videoprojector $videoprojector): Response
    {
        return $this->render('back/material/videoprojector/show.html.twig', [
            'videoprojector' => $videoprojector,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_back_material_videoprojector_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Videoprojector $videoprojector, VideoprojectorRepository $videoprojectorRepository, InternalLocationRepository $internalLocationRepository, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(VideoprojectorType::class, $videoprojector);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $status =$form->getData()->getStatus();

            $id = $form->getData()->getId();

            if ($status === "Available") {

                $datas = $videoprojectorRepository->findVideoprojectorAndInternalLocation($id);

                foreach ($datas as $data) {

                    $idLocation = $data['id'];

                    $idMaterial = $data['videoprojector_id'];

                    $statusToUpdate = $videoprojectorRepository->find($idMaterial);

                    $statusToUpdate->setStatus('Available');

                    $em->flush($statusToUpdate);


                    $newInternalLocation = $internalLocationRepository->find($idLocation);

                    $newInternalLocation->setVideoprojector(null);

                    $em->flush($newInternalLocation);

                }
                    
            }

            $videoprojectorRepository->add($videoprojector, true);

            return $this->redirectToRoute('app_back_material_videoprojector_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/material/videoprojector/edit.html.twig', [
            'videoprojector' => $videoprojector,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_material_videoprojector_delete", methods={"POST"})
     */
    public function delete(Request $request, Videoprojector $videoprojector, VideoprojectorRepository $videoprojectorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$videoprojector->getId(), $request->request->get('_token'))) {
            $videoprojectorRepository->remove($videoprojector, true);
        }

        return $this->redirectToRoute('app_back_material_videoprojector_index', [], Response::HTTP_SEE_OTHER);
    }
}
