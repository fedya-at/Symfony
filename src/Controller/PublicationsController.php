<?php

namespace App\Controller;
use App\Entity\Publication;
use App\Form\PublicationType;
use Doctrine\ORM\EntityManagerInterface;    
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PublicationsController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }
    #[Route('/publications', name: 'app_publications')]
    public function index(): Response
    {
        $publications = $this->em->getRepository(Publication::class)->findAll();

        return $this->render('publications/index.html.twig', [
            'controller_name' => 'PublicationsController',
            'publications' => $publications,
        ]);
    }

    #[Route('/create-publication', name: 'create-publication')]
public function createPublication(Request $request){
$publication=new Publication();
$form = $this->createForm(PublicationType::class, $publication);
$form->handleRequest( $request );
if($form->isSubmitted() && $form->isValid()){
    $this->em->persist($publication);
    $this->em->flush();
}
return $this->render('publications/index.html.twig', ['form' => $form->createView(), 'publication' => $publication]);

}
#[Route('/edit-publication/{id}', name: 'edit-publication')]
    public function editPublication(Request $request, Publication $publication)
    {
        $form = $this->createForm(PublicationType::class, $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            return $this->redirectToRoute('app_publications');
        }

        return $this->render('publications/edit_publication.html.twig', ['form' => $form->createView(), 'publication' => $publication,]);
    }

    #[Route('/delete-publication/{id}', name: 'delete-publication')]
    public function deletePublication(Publication $publication)
    {
        $this->em->remove($publication);
        $this->em->flush();

        return $this->redirectToRoute('app_publications');
    }
}
