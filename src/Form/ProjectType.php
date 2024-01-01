<?php

namespace App\Form;

use App\Entity\Chercheur;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titre',TextType::class,['label' => 'Titre', 'attr'=>['placeholder' => 'Entre titre de projet']])
            ->add('Description',TextareaType::class,['label' => 'Description', 'attr'=>['placeholder' => 'Describe your project']])
            ->add('dateDebut',DateType::class)
            ->add('dateFin',DateType::class)
            ->add('Avancement',ChoiceType::class,['label' => 'Avancement', 'choices'  => [
                'Ongoing' => 'ongoing',
                'Done' => 'done',
        
            ],])
            ->add('chercheurs', EntityType::class, [
                'class' => Chercheur::class,
'choice_label' => 'Nom',
'multiple' => true,
            ])
            ->add('Add', SubmitType::class,['attr'=>['class' =>'btn btn-primary mt-2']]);

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
