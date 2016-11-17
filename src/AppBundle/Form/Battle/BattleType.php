<?php

namespace AppBundle\Form\Battle;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BattleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                    'label' => 'Nom de la bataille :',
                    'required' => true,
            ))
            ->add('date', DateTimeType::class, array(
              'input' => 'datetime',
              'date_format' => 'dd/MM/yyyy',
              'years' => range('2000', '2030'),
                'label' => 'date :',
            ))
            ->add('lieu', TextType::class, array(
                    'label' => 'Lieu de la bataille',
                    'required' => true,
            ))
            ->add('save', SubmitType::class)
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Battle\Battle',
        ));
    }
}
