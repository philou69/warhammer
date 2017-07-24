<?php


namespace AppBundle\Form\Type\Army;


use AppBundle\Repository\Unit\EquipementRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiguirineArmyType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'AppBundle\Entity\Army\FigurineArmy',
            ]
        );
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // On récupere l'entité figurineArmy du form
        $figurineArmy = $builder->getData();

        $builder->add(
            'quantity',
            NumberType::class,
            [
                'attr' => [
                    'min' => $figurineArmy->getFigurine()->getMinQuantity(),
                    'max' => $figurineArmy->getFigurine()->getMaxQunatity(),
                ],
            ]
        )
            ->add(
                'equipements', EntityType::class, [
                'class' => 'AppBundle\Entity\Unit\Equipement',
                'query_builder' => function (EquipementRepository $equipementRepository) use ($figurineArmy){
                            return $equipementRepository->findByFigurine($figurineArmy->getFigurine());
                     },
                'expanded' => true,
                'multiple' => true
            ])
            ;
    }
}