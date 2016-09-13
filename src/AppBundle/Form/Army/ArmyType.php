<?php

namespace AppBundle\Form\Army;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ArmyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                    'label' => 'Nom de l\'armée :',
            ))
            ->add('race', EntityType::class, array(
                'class' => 'AppBundle:Army\Race',
                'choice_label' => 'name',
                'label' => 'Race de l\'armée :',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'placeholder' => 'Séléctionner une race',
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Enregistrer',
    ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Army\Army',
        ));
    }
}
