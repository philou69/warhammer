<?php

namespace AppBundle\Form\Battle;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ParticipantType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('presence', EntityType::class, array(
              'class' => 'AppBundle:Battle\Presence',
              'query_builder' => function (PresenceRepository $er) {
                  return $er->findwithoutNonRepondu();
              },
                'label' => 'Présence :',
              'choice_label' => 'presence',
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Battle\Participant',
        ));
    }
}
