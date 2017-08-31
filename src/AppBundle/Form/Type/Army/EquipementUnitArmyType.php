<?php


namespace AppBundle\Form\Type\Army;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipementUnitArmyType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Army\UnitArmy'
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('figurines', CollectionType::class, [
            'entry_type' => FigurineArmyType::class,
            'allow_add' => false,
            'allow_delete' => false
        ])
            ->add('file', FileType::class, array(
                    'label' => 'Photo de l\'unité',
                    'attr' => array(
                        'accept' => 'image/*',
                    ),
                    'mapped' => false,
                    'required' => false,
                )
            )
            ->add('save', SubmitType::class);
    }
}
