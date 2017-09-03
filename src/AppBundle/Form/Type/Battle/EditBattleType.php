<?php

namespace AppBundle\Form\Type\Battle;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class EditBattleType extends BattleType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $battle = $builder->getData();
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent  $event) use ($options){
            $battle = $event->getData();
            $form = $event->getForm();

            $now = new \DateTime();
            if($battle->getDate() < $now){
                $form->add('participants', CollectionType::class, array(
                    'entry_type' => ParticipantsType::class,
                    'by_reference' => false,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'required' => false,
                    'label_attr' => array('id' => 'photo', 'class' => 'col-sm-2'),
                    'label' => 'Participants :',
                ))
                    ->add('date',DateTimeType::class, [
                        'years' => range(2000, (int)$now->format('Y'))
                    ]);
            }
        });

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Battle\Battle',
        ));
    }
}
