<?php


namespace AppBundle\Form\Type\Army;


use AppBundle\Entity\Army\FigurineArmy;
use AppBundle\Repository\Unit\EquipementRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
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
        // Utilisation de l'eventListener de Form pour récuperer les données necessaire.
        // Plus d'infos, https://stackoverflow.com/questions/9723713/symfony-form-access-entity-inside-child-entry-type-in-a-collectiontype
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($builder) {
                // On recupere le formulaire et l'entité figurine qui est contenue dans l'event
                $form = $event->getForm();
                $figurineArmy = $event->getData();

                if ($figurineArmy instanceof FigurineArmy) {
                    $form->add('quantity', RangeType::class, [
                            'attr' => [
                                'min' => $figurineArmy->getFigurine()->getMinQuantity(),
                                'max' => $figurineArmy->getFigurine()->getMaxQuantity(),
                                'value' => $figurineArmy->getFigurine()->getMinQuantity()
                            ],
                        ]
                    )
                        ->add( 'equipements', EntityType::class, [
                                'class' => 'AppBundle\Entity\Unit\Equipement',
                                'query_builder' => function (EquipementRepository $equipementRepository) use (
                                    $figurineArmy
                                ) {
                                    return $equipementRepository->findByFigurine($figurineArmy->getFigurine());
                                },
                                'expanded' => true,
                                'multiple' => true,
                            ]
                        );
                }
            }
        );

        // On récupere l'entité figurineArmy du form
//        $figurineArmy = $builder->getData();
//        var_dump($builder);
//        exit;


    }
}