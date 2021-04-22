<?php

namespace App\Form;

use App\Entity\Frais;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FraisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('noteFraisMois')
            ->add('noteFraisAnnuelle')
            ->add('user')
            ->add('montant')
            ->add('validation',CheckboxType::class,['required'=> false]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Frais::class,
        ]);
    }
}

/**
 * , 'is_granted_attribute'=>'ROLE_VALIDEUR'
 */