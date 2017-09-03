<?php


namespace AppBundle\Form\Type\Army;


use Symfony\Component\Form\FormBuilderInterface;

class EditArmyType extends ArmyType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->remove('race');
    }
}