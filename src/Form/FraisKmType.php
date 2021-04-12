<?php

namespace App\Form;

use App\Entity\FraisKm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FraisKmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('distance')
            ->add('cv')
            ->add('depart')
            ->add('arrivee')
            ->add('montant')
            ->add('frais')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FraisKm::class,
        ]);
    }
}
