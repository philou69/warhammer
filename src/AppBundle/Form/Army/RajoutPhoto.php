<?php

namespace AppBundle\Form\Army;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Army\Race;

class RajoutPhoto extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('photos', CollectionType::class, array(
                    'entry_type' => PhotoFigurineType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'required' => false,
                    'label_attr' => array('id' => 'photo', 'class' => 'col-sm-2'),
                    'label' => 'Photo',
                ))
            ->add('save', SubmitType::class, array(
                    'label' => 'Enregistrer',
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Army\FigurineArmy',
        ));

        $resolver->setRequired('race');
        $resolver->setAllowedTypes('race', Race::class);
    }
}
