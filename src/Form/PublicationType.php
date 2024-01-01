<?php

namespace App\Form;

use App\Entity\Chercheur;
use App\Entity\Project;
use App\Entity\Publication;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class PublicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titre',TextType::class,['label' => 'Titre', 'attr'=>['placeholder' => 'Entre titre de Rechereche']])
            ->add('Auteur',TextType::class,['label' => 'Auteur', 'attr'=>['placeholder' => 'Entre Auteur de projet']])
            ->add('MotsCle',TextType::class,['label' => 'Mots Clés', 'attr'=>['placeholder' => 'Entre Mot Cle de projet']])
            ->add('Project', EntityType::class, [
                'class' => Project::class,
'choice_label' => 'Titre',
'multiple' => true,
            ])
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
            'data_class' => Publication::class,
        ]);
    }
}
