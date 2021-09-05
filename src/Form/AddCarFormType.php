<?php

namespace App\Form;

// use App\Entity\Cars;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
// use Symfony\bridge\Doctrine\Form\Type\EntityType;

class AddCarFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('id',           TextType::class)
            ->add('brand',        TextType::class, ['attr' => [
                'class'       => 'Brand',
                'placeholder' => 'Car brand'
            ]])
            ->add('model',        TextType::class, ['attr' => [
                'class'       => 'Model',
                'placeholder' => 'Car model'
            ]])
            ->add('manufacturer', TextType::class, ['attr' => [
                'class'       => 'Manufacturer',
                'placeholder' => 'Car manufacturer'
            ]])
            ->add('year',         TextType::class, ['attr' => [
                'class'       => 'Year',
                'placeholder' => 'Car year',
                'pattern' => '\d{4}'
            ]])
            ->add('Add',          SubmitType::class)
            ->add('Cancel',       ButtonType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // 'data_class' => Cars::class,
            'data_class' => null
        ]);
    }
}
