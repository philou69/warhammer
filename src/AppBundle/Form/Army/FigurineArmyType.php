<?php

namespace AppBundle\Form\Army;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Repository\Army\FigurineRepository;
use AppBundle\Repository\Army\EquipementRepository;
use AppBundle\Entity\Army\Race;
use AppBundle\Form\Army\PhotoFigurineType;

class FigurineArmyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $race = $options['race'];
        $builder
            ->add('figurine',EntityType::class, array(
                    'class' => 'AppBundle:Army\Figurine',
                    'query_builder' => function(FigurineRepository $er) use ($race)
                    {
                        return $er->findByRace($race);
                    },
                    'label' => 'Figurine : ',
                    'choice_label' => 'NameAndPoints',
                    'group_by' => 'groupe.name',
                    'placeholder' => 'Choisisez une figurine',
                    ))
            ->add('equipements', EntityType::class, array(
                    'class' => 'AppBundle:Army\Equipement',
                    'query_builder' => function(EquipementRepository $er) use ($race)
                    {
                        return $er->findByRace($race);
                    },
                    'choice_label' =>'NameAndPoints',
                    'choice_attr' => function($choice){
                        $datas = array();
                        foreach ($choice->getFigurines() as $figurine) {
                            $datas['data-'.$figurine->getFigurine()->getId()] = 1;
                        }
                        $datas['class'] = 'option';
                        return $datas;
                    },
                    'label_attr' => array('id' => 'options'),
                    'label' => 'Options de la figurine :',
                    'expanded' =>  true,
                    'multiple' => true,
                    'required' => false,
                    ))
            ->add('photos', CollectionType::class, array(
                    'entry_type' =>PhotoFigurineType::class,
                    'by_reference' => false,
                    'allow_add' =>true,
                    'allow_delete' =>true,
                    'required' =>false,
                    'label_attr' => array('id' =>'photo','class' => 'col-sm-2'),
                    'label' => 'Photos :'
                ))
            ->add('save', SubmitType::class, array(
                    'label' => 'Enregistrer'
            ));
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Army\FigurineArmy'
        ));

        $resolver->setRequired('race');
        $resolver->setAllowedTypes('race', Race::class);
    }
}
