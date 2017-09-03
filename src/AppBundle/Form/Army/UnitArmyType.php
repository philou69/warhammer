<?php

namespace AppBundle\Form\Army;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Repository\Army\UnitRepository;
use AppBundle\Repository\Army\EquipementRepository;
use AppBundle\Entity\Army\Race;

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
                    'class' => 'AppBundle:Army\Unit',
                    'query_builder' => function (UnitRepository $er) use ($race) {
                        return $er->findByRace($race);
                    },
                    'label' => 'Unit : ',
                    'choice_label' => 'NameAndPoints',
                    'group_by' => 'groupe.name',
                    'placeholder' => 'Choisisez une unit',
                    ))
            ->add('equipements', EntityType::class, array(
                    'class' => 'AppBundle:Army\Equipement',
                    'query_builder' => function (EquipementRepository $er) use ($race) {
                        return $er->findByRace($race);
                    },
                    'choice_label' => 'NameAndPoints',
                    'choice_attr' => function ($choice) {
                        $datas = array();
                        foreach ($choice->getUnits() as $unit) {
                            $datas['data-'.$unit->getId()] = $unit->getId();
                        }
                        $datas['class'] = 'option';

                        return $datas;
                    },
                    'label_attr' => array('id' => 'options'),
                    'label' => 'Options de la unit :',
                    'expanded' => true,
                    'multiple' => true,
                    'required' => false,
                    ))
                ->add('files', FileType::class, array(
                    'label' => 'Photos de la unit',
                'multiple' => "multiple",
                    'attr' => array(
                        'accept' => 'image/*',
                    ),
                    'mapped' => false,
                    'required' => false
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
            'data_class' => 'AppBundle\Entity\Army\UnitArmy',
        ));

        $resolver->setRequired('race');
        $resolver->setAllowedTypes('race', Race::class);
    }
}