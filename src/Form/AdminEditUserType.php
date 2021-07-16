<?php

namespace App\Form;

use App\Entity\User;
use App\Form\FormConfig\FormConfig;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @SuppressWarnings("unused")
 */
class AdminEditUserType extends FormConfig
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, $this->getFormConf(true, false, false))
            ->add('roles', ChoiceType::class, [
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Administrateur' => 'ROLE_ADMIN',
                    'Conducteur(rice)' => 'ROLE_DRIVER',
                    'Client' => 'ROLE_CLIENT'
                ],
            ])
            // ->add('password', PasswordType::class, $this->getFormConf(true, false, false))
            ->add('isVerified', ChoiceType::class, [
                'placeholder' => false,
                'label' => false,
                'required' => true,
                'choices' => [
                    'Non' => false,
                    'Oui' => true,
                    // à compléter
                ],
            ])
            // ->add('createdAt')
            // ->add('desactivationAt')
            ->add('agreeTerms', ChoiceType::class, [
                'placeholder' => false,
                'label' => false,
                'required' => true,
                'choices' => [
                    'Non' => false,
                    'Oui' => true,
                    // à compléter
                ],
            ])
            // ->add('agreeTermsValidAt')
            ->add('status', ChoiceType::class, [
                'placeholder' => false,
                'label' => false,
                'required' => true,
                'choices' => [
                    'Inconnu' => 0,
                    'Actif' => 1,
                    'Inactif' => 2,
                    // à compléter
                ],
            ])
            // ->add('student')
            // ->add('parentStudent')
            // ->add('admin')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
