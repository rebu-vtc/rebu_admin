<?php

namespace App\Form;

use App\Entity\Student;
use App\Form\FormConfig\FormConfig;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @SuppressWarnings("unused")
 */
class AdminStudentType extends FormConfig
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dob', DateType::class, [
                'widget' => 'single_text',

                // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => false,

                // adds a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker form-control'],
            ])
            ->add('nationality', CountryType::class, [
                'placeholder' => false,
                'label' => false,
                'required' => true,
            ])
            ->add('sex', ChoiceType::class, [
                'placeholder' => false,
                'label' => false,
                'required' => true,
                'choices' => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                    'Autre' => 'Autre',
                    'Non précisé' => 'Non précisé',
                    // à compléter
                ],
            ])
            ->add('placeOfBirth', TextType::class, $this->getFormConf(true, false, false))
            ->add('departementOfBirth', TextType::class, $this->getFormConf(true, false, false))
            ->add('countryOfBirth', CountryType::class, [
                'placeholder' => false,
                'label' => false,
                'required' => true,
            ])
            ->add('firstName', TextType::class, $this->getFormConf(true, false, false))
            ->add('lastName', TextType::class, $this->getFormConf(true, false, false))
            ->add('civility', ChoiceType::class, [
                'placeholder' => false,
                'label' => false,
                'required' => true,
                'choices' => [
                    'Mme' => 'Mme',
                    'Mr' => 'Mr',
                    'Mlle' => 'Mlle',
                    'Autre' => 'Autre',
                    // à compléter
                ],
            ])
            ->add('parents', EntityType::class, [
                'class' => 'App\Entity\ParentStudent',
                'label' => false,
                'choice_label' => 'getFullName',
                'required' => true,
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('user', EntityType::class, [
                'class' => 'App\Entity\User',
                'label' => false,
                'choice_label' => 'email',
                'required' => true,
                'expanded' => false,
                'multiple' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
