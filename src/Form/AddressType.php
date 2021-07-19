<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('addressLine1', TextType::class, [
                'label' => 'N° at Rue '
            ])
            ->add('addressLine2', TextType::class, [
                'label' => 'N° Porte',
                
            ])
            ->add('addressLine3', TextType::class, [
                'label' => 'Info Complementaire',
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Profession' => 0,
                    'Maison' => 1,
                    'Other' => 2,
                ]
            ])
            ->add('Codepostal')
            ->add('ville')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
