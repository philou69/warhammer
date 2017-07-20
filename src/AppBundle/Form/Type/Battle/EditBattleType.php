<?php

namespace AppBundle\Form\Type\Battle;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EditBattleType extends AbstractType
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
            ))
            ->add('date', DateTimeType::class, array(
                'input' => 'datetime',
                'date_format' => 'dd/MM/yyyy',
                'years' => range('2000', '2030'),
                'label' => 'date :',
            ))
            ->add('lieu', TextType::class, array(
                'label' => 'Lieu de la bataille',
            ))
            ->add('participants', CollectionType::class, array(
                    'entry_type' => ParticipantsType::class,
                    'by_reference' => false,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'required' => false,
                    'label_attr' => array('id' => 'photo', 'class' => 'col-sm-2'),
                    'label' => 'Participants :',
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
