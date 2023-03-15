<?php

namespace App\Controller\Back\Material;

use App\Entity\Laptop;
use App\Form\InternalLocationType;
use App\Form\LaptopType;
use App\Repository\InternalLocationRepository;
use App\Repository\LaptopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/material/laptop")
 */
class LaptopController extends AbstractController
{
    /**
     * @Route("/", name="app_back_material_laptop_index", methods={"GET"})
     */
    public function index(LaptopRepository $laptopRepository): Response
    {
        return $this->render('back/material/laptop/index.html.twig', [
            'laptops' => $laptopRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_back_material_laptop_new", methods={"GET", "POST"})
     */
    public function new(Request $request, LaptopRepository $laptopRepository): Response
    {
        $laptop = new Laptop();
        $form = $this->createForm(LaptopType::class, $laptop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $laptopRepository->add($laptop, true);

            return $this->redirectToRoute('app_back_material_laptop_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/material/laptop/new.html.twig', [
            'laptop' => $laptop,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_material_laptop_show", methods={"GET"})
     */
    public function show(Laptop $laptop): Response
    {
        return $this->render('back/material/laptop/show.html.twig', [
            'laptop' => $laptop,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_back_material_laptop_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Laptop $laptop, LaptopRepository $laptopRepository, InternalLocationRepository $internalLocationRepository): Response
    {
        $form = $this->createForm(LaptopType::class, $laptop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
    
            $status =$form->getData()->getStatus();
            $id = $form->getData()->getId();

            if($status === "available"){

                $datas = $laptopRepository->findLaptopAndInternalLocation($id);

                foreach($datas as $data){

                    $id = $data['internal_location_id'];

                    $newInternalLocation = $internalLocationRepository->find($id);

                    $newInternalLocation->removeLaptop($laptop);

                }

            }


            $laptopRepository->add($laptop, true);

            return $this->redirectToRoute('app_back_material_laptop_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/material/laptop/edit.html.twig', [
            'laptop' => $laptop,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_material_laptop_delete", methods={"POST"})
     */
    public function delete(Request $request, Laptop $laptop, LaptopRepository $laptopRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$laptop->getId(), $request->request->get('_token'))) {
            $laptopRepository->remove($laptop, true);
        }

        return $this->redirectToRoute('app_back_material_laptop_index', [], Response::HTTP_SEE_OTHER);
    }
}
