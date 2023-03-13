<?php

namespace App\Controller\Back\Material;

use App\Entity\Computer;
use App\Form\ComputerType;
use App\Repository\ComputerRepository;
use App\Repository\InternalLocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/material/computer")
 */
class ComputerController extends AbstractController
{
    /**
     * @Route("/", name="app_back_material_computer_index", methods={"GET"})
     */
    public function index(ComputerRepository $computerRepository): Response
    {
        return $this->render('back/material/computer/index.html.twig', [
            'computers' => $computerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_back_material_computer_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ComputerRepository $computerRepository): Response
    {
        $computer = new Computer();
        $form = $this->createForm(ComputerType::class, $computer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $computerRepository->add($computer, true);

            return $this->redirectToRoute('app_back_material_computer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/material/computer/new.html.twig', [
            'computer' => $computer,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_material_computer_show", methods={"GET"})
     */
    public function show(Computer $computer): Response
    {
        return $this->render('back/material/computer/show.html.twig', [
            'computer' => $computer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_back_material_computer_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Computer $computer, ComputerRepository $computerRepository, InternalLocationRepository $internalLocationRepository): Response
    {
        $form = $this->createForm(ComputerType::class, $computer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $status =$form->getData()->getStatus();
            $id = $form->getData()->getId();

            if($status === "available"){

                $datas = $computerRepository->findComputerAndInternalLocation($id);

                foreach($datas as $data){

                    $id = $data['internal_location_id'];

                    $newInternalLocation = $internalLocationRepository->find($id);

                    $newInternalLocation->removeComputer($computer);
                    
                }

            }


            $computerRepository->add($computer, true);

            return $this->redirectToRoute('app_back_material_computer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/material/computer/edit.html.twig', [
            'computer' => $computer,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_material_computer_delete", methods={"POST"})
     */
    public function delete(Request $request, Computer $computer, ComputerRepository $computerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$computer->getId(), $request->request->get('_token'))) {
            $computerRepository->remove($computer, true);
        }

        return $this->redirectToRoute('app_back_material_computer_index', [], Response::HTTP_SEE_OTHER);
    }
}
