<?php

namespace App\Form;

use App\Entity\Chercheur;
use App\Entity\Equipment;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EquipmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,['label' => 'Nom', 'attr'=>['placeholder' => 'Entre votre nom']])
            ->add('state',TextType::class,['label' => 'State', 'attr'=>['placeholder' => 'Entre votre nom']])
            ->add('availability',TextType::class,['label' => 'Availibility', 'attr'=>['placeholder' => 'Entre availibilty']])
            ->add('chercheur', EntityType::class, [
                'class' => Chercheur::class,
'choice_label' => 'Nom',
            ])
            ->add('project', EntityType::class, [
                'class' => Project::class,
'choice_label' => 'Titre',
            ])
            ->add('Add', SubmitType::class,['attr'=>['class' =>'btn btn-primary mt-2']]);


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipment::class,
        ]);
    }
}
