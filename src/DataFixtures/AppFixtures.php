<?php

namespace App\DataFixtures;


use App\Entity\Chercheur;
use App\Entity\Project;
use App\Entity\Equipment;
use App\Entity\Publication;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $chercheur1 = new Chercheur();
        $chercheur1->setNom('John');
        $chercheur1->setPrenom('Doe');
        $chercheur1->setEmail('john.doe@example.com');
        $chercheur1->setPassword('password'); // You should hash the password in a real application
        $chercheur1->setRole('chercheur_principal');
        $chercheur1->setBirth(new \DateTime('1990-01-01'));
        $manager->persist($chercheur1);

        $chercheur2 = new Chercheur();
        $chercheur2->setNom('Jane');
        $chercheur2->setPrenom('Doe');
        $chercheur2->setEmail('jane.doe@example.com');
        $chercheur2->setPassword('password'); // You should hash the password in a real application
        $chercheur2->setRole('collaborateur');
        $chercheur2->setBirth(new \DateTime('1995-02-15'));
        $manager->persist($chercheur2);

        // Create Projects
        $project1 = new Project();
        $project1->setTitre('Project A');
        $project1->setDescription('Description of Project A');
        $project1->setDateDebut(new \DateTime('2022-01-01'));
        $project1->setDateFin(new \DateTime('2022-12-31'));
        $project1->setAvancement('In Progress');
        $project1->addChercheur($chercheur1);
        $project1->addChercheur($chercheur2);
        $manager->persist($project1);

        $project2 = new Project();
        $project2->setTitre('Project B');
        $project2->setDescription('Description of Project B');
        $project2->setDateDebut(new \DateTime('2023-03-15'));
        $project2->setDateFin(new \DateTime('2023-12-15'));
        $project2->setAvancement('Completed');
        $project2->addChercheur($chercheur2);
        $manager->persist($project2);

        // Create Publications
        $publication1 = new Publication();
        $publication1->setTitre('Publication X');
        $publication1->setAuteur('John Doe');
        $publication1->setMotsCle('Keyword1, Keyword2');
        $publication1->addChercheur($chercheur1);
        $publication1->addProject($project1);
        $manager->persist($publication1);

        $publication2 = new Publication();
        $publication2->setTitre('Publication Y');
        $publication2->setAuteur('Jane Doe');
        $publication2->setMotsCle('Keyword3, Keyword4');
        $publication2->addChercheur($chercheur2);
        $publication2->addProject($project2);
        $manager->persist($publication2);

        $manager->flush();

        // Equipment fixtures
        $equipment = new Equipment();
        $equipment->setName('Equipment Name');
        $equipment->setState('Working');
        $equipment->setAvailability('Available');
        
        // Set Chercheur and Project (replace 1 and 2 with the actual IDs)
        $chercheur = $manager->getRepository(Chercheur::class)->find(1);
        $project = $manager->getRepository(Project::class)->find(2);
        $equipment->setChercheur($chercheur);
        $equipment->setProject($project);

        $manager->persist($equipment);
        $manager->flush();
    }
}
