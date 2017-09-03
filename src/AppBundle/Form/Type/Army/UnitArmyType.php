<?php

namespace AppBundle\Form\Type\Army;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Repository\Unit\UnitRepository;
use AppBundle\Entity\Unit\Race;

class UnitArmyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $race = $options['race'];
        $builder
            ->add('unit', EntityType::class, array(
                    'class' => 'AppBundle:Unit\Unit',
                    'query_builder' => function (UnitRepository $er) use ($race) {
                        return $er->findByRace($race);
                    },
                    'label' => 'Unit : ',
                    'choice_label' => 'name',
                    'group_by' => 'groupe.name',
                    'placeholder' => 'Choisisez une unit',
                    ))
            ->add('save', SubmitType::class, array(
                    'label' => 'Passer aux figurines',
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Army\UnitArmy',
        ));
        $resolver->setRequired('race');
        $resolver->setAllowedTypes('race', Race::class);
    }
}
