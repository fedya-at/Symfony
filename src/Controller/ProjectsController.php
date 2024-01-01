<?php

namespace App\Controller;
use App\Entity\Project;
use App\Form\ProjectType;
use Doctrine\ORM\EntityManagerInterface;    
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProjectsController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }
    #[Route('/projects', name: 'app_projects')]
    public function index(): Response
    {
        $projects = $this->em->getRepository(Project::class)->findAll();

        return $this->render('projects/index.html.twig', [
            'controller_name' => 'ProjectsController',
            'projects' => $projects,

        ]);
    }
    #[Route('/create-project', name: 'create-project')]
public function createProject(Request $request){
$project=new Project();
$form = $this->createForm(ProjectType::class, $project);
$form->handleRequest( $request );
if($form->isSubmitted() && $form->isValid()){
    $this->em->persist($project);
    $this->em->flush();
}
return $this->render('projects/index.html.twig', ['form' => $form->createView(), 'project' => $project]);

}
#[Route('/edit-project/{id}', name: 'edit-project')]
public function editProject(Request $request, Project $project)
{
    $form = $this->createForm(ProjectType::class, $project);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $this->em->flush();

        return $this->redirectToRoute('app_projects');
    }

    return $this->render('projects/edit_project.html.twig', ['form' => $form->createView(), 'project' => $project,]);
}

#[Route('/delete-project/{id}', name: 'delete-project')]
public function deleteProject(Project $project)
{
    $this->em->remove($project);
    $this->em->flush();

    return $this->redirectToRoute('app_projects');
}
}
