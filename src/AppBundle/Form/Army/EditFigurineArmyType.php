<?php

namespace AppBundle\Form\Army;

use AppBundle\Entity\Army\FigurineArmy;
use AppBundle\Entity\Army\PhotoFigurine;
use AppBundle\Repository\Army\PhotoFigurineRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Repository\Army\EquipementRepository;
use AppBundle\Entity\Army\Figurine;

class EditFigurineArmyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $figurine = $builder->getData();
        $builder
            ->add('equipements', EntityType::class, array(
                    'class' => 'AppBundle:Army\Equipement',
                    'query_builder' => function (EquipementRepository $er) use ($figurine) {
                        return $er->findByFigurine($figurine->getFigurine());
                    },
                    'choice_label' => 'NameAndPoints',
                    'choice_attr' => function ($choice) {
                        $datas = array();
                        foreach ($choice->getFigurines() as $figurine) {
                            $datas['data-'.$figurine->getFigurine()->getId()] = 1;
                        }
                        $datas['class'] = 'option';

                        return $datas;
                    },
                    'label_attr' => array('id' => 'options'),
                    'label' => 'Option de la figurine :',
                    'expanded' => true,
                    'multiple' => true,
                    'required' => false,
                    ))
            ->add('photos', EntityType::class, array(
                'class' => 'AppBundle\Entity\Army\PhotoFigurine',
                'query_builder' =>function (PhotoFigurineRepository $er) use ($figurine) {
                    return $er->findForFigurine($figurine);
                },
                'label' => 'photos de la figurine',
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
            'data_class' => 'AppBundle\Entity\Army\FigurineArmy',
        ));

    }
}
