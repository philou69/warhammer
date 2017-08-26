<?php

namespace AppBundle\Form\Type\Army;

use AppBundle\Repository\Army\PictureUnitRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Repository\Army\EquipementRepository;

class EditUnitArmyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $unit = $builder->getData();
        $builder
            ->add('equipements', EntityType::class, array(
                    'class' => 'AppBundle:Army\Equipement',
                    'query_builder' => function (EquipementRepository $er) use ($unit) {
                        return $er->findByUnit($unit->getUnit());
                    },
                    'choice_label' => 'NameAndPoints',
                    'choice_attr' => function ($choice) {
                        $datas = array();
                        foreach ($choice->getUnits() as $unit) {
                            $datas['data-'.$unit->getId()] = 1;
                        }
                        $datas['class'] = 'option';

                        return $datas;
                    },
                    'label_attr' => array('id' => 'options'),
                    'label' => 'Option de la unit :',
                    'expanded' => true,
                    'multiple' => true,
                    'required' => false,
                    ))
            ->add('photos', EntityType::class, array(
                'class' => 'AppBundle\Entity\Army\PhotoUnit',
                'query_builder' =>function (PictureUnitRepository $er) use ($unit) {
                    return $er->findForUnit($unit);
                },
                'label' => 'photos de la unit',
                'choice_label' => 'webPath',
                'expanded' => true,
                'multiple' => true,
            ))
            ->add('files', FileType::class, array(
                'label' => 'Upload de photos',
                'multiple' => true,
                'mapped' => false,
                'required' => false,
                'attr' => array(
                    'accept' => 'image/*'
                )
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

    }
}
