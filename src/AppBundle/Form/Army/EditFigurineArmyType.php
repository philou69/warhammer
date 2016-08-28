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
use AppBundle\Entity\Army\Figurine;
use AppBundle\Form\Army\PhotoFigurineType;

class EditFigurineArmyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $figurineArmy = $options['figurine'];
        $builder
            ->add('equipements', EntityType::class, array(
                    'class' => 'AppBundle:Army\Equipement',
                    'query_builder' => function(EquipementRepository $er) use ($figurineArmy)
                    {
                        return $er->findByFigurine($figurineArmy);
                    },
                    'choice_label' =>'NameAndPoints',
                    'choice_attr' => function($choice, $index, $value){
                        $datas = array();
                        foreach ($choice->getFigurines() as $figurine) {
                            $datas['data-'.$figurine->getFigurine()->getId()] = 1;
                        }
                        $datas['class'] = 'option';
                        return $datas;
                    },
                    'label_attr' => array('id' => 'options'),
                    'expanded' =>  true,
                    'multiple' => true,
                    'required' => false,
                    ))
            ->add('save', SubmitType::class);
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

        $resolver->setRequired('figurine');
        $resolver->setAllowedTypes('figurine', Figurine::class);
    }
}
