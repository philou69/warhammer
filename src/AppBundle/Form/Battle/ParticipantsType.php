<?php

namespace AppBundle\Form\Battle;

use AppBundle\Entity\User\User;
use AppBundle\Repository\Army\ArmyRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Repository\Battle\PresenceRepository;
class ParticipantsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('participant', EntityType::class, array(
                'class' => 'AppBundle:User\User',
                'label' => 'Participant:',
                'choice_label' => 'username',
                'label_attr' => array('class' => 'col-sm-2 control-label '),
                'placeholder' => 'Qui a combattu ?',
                'choice_attr' => function () {
                    return ['class' => 'participant'];
                }

            ))
            ->add('army', EntityType::class, array(
                'class' => 'AppBundle:Army\Army',
                'label' => 'Armée utilisée :',
                'placeholder' => 'Choisissez l\'armée utilisée',
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'choice_attr' => function ($choice) {
                    $datas = array();
                    $datas['data-participant'] = $choice->getUser()->getId();
                    $datas['class'] = 'armee';

                    return $datas;
                },
                'choice_label' => 'name',
                'required' => false
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
