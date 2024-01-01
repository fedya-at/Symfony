<?php

namespace App\Controller;
use App\Entity\Equipment;
use App\Form\EquipmentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;

class EquipmentController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    #[Route('/equipment', name: 'app_equipment')]
    public function index(): Response
    {
        $equipments = $this->em->getRepository(Equipment::class)->findAll();
        return $this->render('equipment/index.html.twig', [
            'controller_name' => 'EquipmentController',
            'equipments' => $equipments,
        ]);
        
    }
    #[Route('/create-equipment', name: 'create-equipment')]
    public function createEquipment(Request $request): Response
    {
        $equipment = new Equipment();
        $form = $this->createForm(EquipmentType::class, $equipment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($equipment);
            $this->em->flush();
            $this->addFlash('success', 'Equipment created successfully.');

            return $this->redirectToRoute('app_equipment');
        }

        return $this->render('equipment/equipment.html.twig', [
            'form' => $form->createView(),
            'equipment' => $equipment,
        ]);
    }
    #[Route('/edit-equipment/{id}', name: 'edit-equipment')]
    public function editEquipment(Request $request, Equipment $equipment)
    {
        $form = $this->createForm(EquipmentType::class, $equipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Equipment updated successfully.');


            return $this->redirectToRoute('app_equipment');
        }

        return $this->render('equipment/edit_equipment.html.twig', ['form' => $form->createView(), 'chercheur' => $equipment,]);
    }

    #[Route('/delete-equipment/{id}', name: 'delete-equipment')]
    public function deleteEquipment(Equipment $equipment)
    {
        $this->em->remove($equipment);
        $this->em->flush();
        $this->addFlash('success', 'Chercheur Deleted successfully.');


        return $this->redirectToRoute('app_chercheurs');
    }

}
