<?php

namespace App\Form;

use App\Entity\Personnel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;


class PersonnelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('dob')
            ->add('facebookToken')
            ->add('idNumber')
            ->add('idcard', CollectionType::class, [
                'entry_type'   => ResourceType::class,
                'entry_options'  => [
                    'label' => false,
                ],
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
                'required' => false,
                'attr'         => [
                    'class' => "image-collection",
                ]
            ])
            /* ->add('address', CollectionType::class, [
                'entry_type'   => AddressType::class,
                'entry_options'  => [
                    'label' => false,
                ],
                'mapped' => false,
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
                'required' => false,
                'attr'         => [
                    'class' => "address-collection",
                ]
            ]) */
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personnel::class,
        ]);
    }
}
