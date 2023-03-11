<?php

namespace App\Controller\Back\Material;

use App\Entity\Monitor;
use App\Form\MonitorType;
use App\Repository\MonitorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/material/monitor")
 */
class MonitorController extends AbstractController
{
    /**
     * @Route("/", name="app_back_material_monitor_index", methods={"GET"})
     */
    public function index(MonitorRepository $monitorRepository): Response
    {
        return $this->render('back/material/monitor/index.html.twig', [
            'monitors' => $monitorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_back_material_monitor_new", methods={"GET", "POST"})
     */
    public function new(Request $request, MonitorRepository $monitorRepository): Response
    {
        $monitor = new Monitor();
        $form = $this->createForm(MonitorType::class, $monitor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $monitorRepository->add($monitor, true);

            return $this->redirectToRoute('app_back_material_monitor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/material/monitor/new.html.twig', [
            'monitor' => $monitor,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_material_monitor_show", methods={"GET"})
     */
    public function show(Monitor $monitor): Response
    {
        return $this->render('back/material/monitor/show.html.twig', [
            'monitor' => $monitor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_back_material_monitor_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Monitor $monitor, MonitorRepository $monitorRepository): Response
    {
        $form = $this->createForm(MonitorType::class, $monitor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $monitorRepository->add($monitor, true);

            return $this->redirectToRoute('app_back_material_monitor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/material/monitor/edit.html.twig', [
            'monitor' => $monitor,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_material_monitor_delete", methods={"POST"})
     */
    public function delete(Request $request, Monitor $monitor, MonitorRepository $monitorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$monitor->getId(), $request->request->get('_token'))) {
            $monitorRepository->remove($monitor, true);
        }

        return $this->redirectToRoute('app_back_material_monitor_index', [], Response::HTTP_SEE_OTHER);
    }
}
