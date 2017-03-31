<?php


namespace AppBundle\Form\Army;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UploadPhotoFigurineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('files', FileType::class, array(
            'label' => 'Photos',
            'multiple' =>true,
            'attr' => array(
                'accept' => 'image/*'
            )
        ))
            ->add('save', SubmitType::class, array(
                'label' => 'Envoyer'
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null,
        ));
    }
}