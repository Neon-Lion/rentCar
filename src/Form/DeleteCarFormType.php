<?php

namespace App\Form;

// use App\Entity\Cars;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DeleteCarFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('brand')
            // ->add('model')
            // ->add('manufacturer')
            // ->add('year')
            ->add('Delete', SubmitType::class)
            ->add('Cancel', ButtonType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // 'data_class' => Cars::class,
            'data_class' => null
        ]);
    }
}
