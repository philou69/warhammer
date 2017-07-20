<?php


namespace AppBundle\Form\Type\Unit;

use AppBundle\Entity\Unit\Figurine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UnitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class)
            ->add('race', EntityType::class, [
                'class' => 'AppBundle\Entity\Unit\Race',
                'choice_label' => 'name',
                'placeholder' => 'Choisisez une race'
            ])
            ->add('groupe', EntityType::class, [
                'class' => 'AppBundle\Entity\Unit\Groupe',
                'choice_label' => 'name',
                'placeholder' => 'Choisisez un groupe'
            ])
            ->add('figurines', CollectionType::class, [
                'entry_type' => FigurineType::class,
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Unit\Unit',
            'cas'
        ));
    }
}