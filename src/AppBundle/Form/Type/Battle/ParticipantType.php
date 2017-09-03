<?php

namespace AppBundle\Form\Type\Battle;

use AppBundle\Entity\User\User;
use AppBundle\Repository\Army\ArmyRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Repository\Battle\PresenceRepository;

class ParticipantType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $participant = $builder->getData();
        $builder
            ->add('presence', EntityType::class, array(
              'class' => 'AppBundle:Battle\Presence',
              'query_builder' => function (PresenceRepository $er) {
                  return $er->findwithoutNonRepondu();
              },
                'label' => 'Présence :',
              'choice_label' => 'presence',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'placeholder' => 'Dites nous si vous serez là.'
            ))
            ->add('army', EntityType::class, array(
                'class' => 'AppBundle:Army\Army',
                'query_builder'=> function(ArmyRepository $er) use ($participant){
                    return $er->findArmiesOfUser($participant->getParticipant());
                },
                'label' => 'Votre armée :',
                'placeholder' => 'Choisissez une armée si vous combattez',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'choice_label' => 'name',
                'required' => false,
//                'attr' => [
//                    'disabled' => $participant->getPresence()->getPresence() === "participerez au combat" ? 'false' : 'disabled'
//                ]
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Enregister'
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
//
//        $resolver->setRequired('user');
//        $resolver->setAllowedTypes('user', User::class);
    }
}
