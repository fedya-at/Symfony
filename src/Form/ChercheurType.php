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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;





class ChercheurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom',TextType::class,['label' => 'Nom', 'attr'=>['placeholder' => 'Entre votre nom']])
            ->add('Prenom',TextType::class,['label' => 'Prenom', 'attr'=>['placeholder' => 'Entre votre prenom']])
            ->add('Email',EmailType::class,['label' => 'Email', 'attr'=>['placeholder' => 'example@gmail.com']])
            ->add('Password',PasswordType::class,['label' => 'Password', 'attr'=>['placeholder' => '*************']])
            ->add('Role',ChoiceType::class,['label' => 'Role', 'choices'  => [
                'Chercheur Principal' => 'chercheur_principal',
                'Collaborateur' => 'collaborateur',
        
            ],])
            ->add('Birth',BirthdayType::class,['label' => 'Birth'])
          

            ->add('Add', SubmitType::class,['attr'=>['class' =>'btn btn-primary mt-2']]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chercheur::class,
        ]);
    }
}
