<?php


namespace AppBundle\Form\Type\Unit;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FigurineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class)
            ->add('type', EntityType::class, [
                'class' => 'AppBundle\Entity\Unit\Type',
                'choice_label' => 'name',
                'placeholder' => 'Choisisez un type de figurine'
            ])
            ->add('points' , NumberType::class)
            ->add('minQuantity',NumberType::class)
            ->add('maxQuantity',NumberType::class)
            ->add('move',NumberType::class)
            ->add('weaponSkill', NumberType::class)
            ->add('balisticSkill', NumberType::class)
            ->add('strength', NumberType::class)
            ->add('toughness', NumberType::class)
            ->add('wounds', NumberType::class)
            ->add('attacks', NumberType::class)
            ->add('leaderShip', NumberType::class)
            ->add('save', NumberType::class)
            ->add('equipements', CollectionType::class, [
                'entry_type' => EquipementType::class,
                'allow_add' => true,
                'allow_delete' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Unit\Figurine'
        ]);
    }
}