<?php

namespace App\Form;

use App\Entity\Bien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nb_piece',NumberType::class,array('label'=>'Nombre de Piece :','attr'=>array('class'=>'form-control','placeholder'=>'ex: 50')))
            ->add('nb_chambre',NumberType::class,array('label'=>'Nombre de chambre :','attr'=>array('class'=>'form-control','placeholder'=>'ex: 50')))
            ->add('superficie',NumberType::class,array('label'=>'Superficie :','attr'=>array('class'=>'form-control','placeholder'=>'ex: 50.75')))
            ->add('prix',NumberType::class,array('label'=>'Quantité du Produit :','attr'=>array('class'=>'form-control','placeholder'=>'ex: 52.99')))
            ->add('chauffage',TextType::class,array('label'=>'Chauffage :','attr'=>array('class'=>'form-control','placeholder'=>'ex: Gaz, Electricite...')))
            ->add('annee',NumberType::class,array('label'=>'Annee :','attr'=>array('class'=>'form-control','placeholder'=>'ex: 2015')))
            ->add('localisation',TextType::class,array('label'=>'Localisation :','attr'=>array('class'=>'form-control','placeholder'=>'ex: Val-de-Marne')))
            ->add('etat',TextType::class,array('label'=>'Etat :','attr'=>array('class'=>'form-control','placeholder'=>'ex: confirmer, en attente...')))
            ->add('Type', EntityType::class, array('class'=>'App\Entity\Type','choice_label' => 'libelle'))
            ->add('valider',SubmitType::class, array('label'=>'Valider','attr'=>array('class'=>'btn btn-primary btn-block')))
            ->add('annuler',ResetType::class, array('label'=>'Quitter','attr'=>array('class'=>'btn btn-primary btn-block')));
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bien::class,
        ]);
    }
}
