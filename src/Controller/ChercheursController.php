<?php

namespace App\Controller;
use App\Form\ChercheurType;
use App\Entity\Chercheur;
use Doctrine\ORM\EntityManagerInterface;    
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordHasherInterface; // Use the correct interface

class ChercheursController extends AbstractController


{

    private $em;
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }
    #[Route('/chercheurs', name: 'app_chercheurs')]
    public function index(): Response
    {
        $chercheurs = $this->em->getRepository(Chercheur::class)->findAll();

        return $this->render('chercheurs/index.html.twig', [
            'controller_name' => 'ChercheursController',
            'chercheurs' => $chercheurs,
        ]);
    }

    
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, EntityManagerInterface $entityManager): Response
    {
        $chercheur = new Chercheur();
        $form = $this->createForm(ChercheurType::class, $chercheur);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Persist the user without hashing the password
            $entityManager->persist($chercheur);
            $entityManager->flush();

            // Redirect to login page or any other route
            return $this->redirectToRoute('app_login');
        }

        return $this->render('chercheurs/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/create-chercheur', name: 'create-chercheur')]

    public function createChercheur(Request $request){
        $chercheur=new Chercheur();
        $form = $this->createForm(ChercheurType::class, $chercheur);
        $form->handleRequest( $request );
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($chercheur);
            $this->em->flush();
            $this->addFlash('success', 'Chercheur created successfully.');

        }
        return $this->render('Chercheurs/chercheur.html.twig', ['form' => $form->createView(), 'chercheur' => $chercheur]);
        }
        #[Route('/edit-chercheur/{id}', name: 'edit-chercheur')]
    public function editChercheur(Request $request, Chercheur $chercheur)
    {
        $form = $this->createForm(ChercheurType::class, $chercheur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Chercheur updated successfully.');


            return $this->redirectToRoute('app_chercheurs');
        }

        return $this->render('chercheurs/edit_chercheur.html.twig', ['form' => $form->createView(), 'chercheur' => $chercheur,]);
    }

    #[Route('/delete-chercheur/{id}', name: 'delete-chercheur')]
    public function deleteChercheur(Chercheur $chercheur)
    {
        $this->em->remove($chercheur);
        $this->em->flush();
        $this->addFlash('success', 'Chercheur Deleted successfully.');


        return $this->redirectToRoute('app_chercheurs');
    }
}
