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
class AdminUserType extends FormConfig
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, $this->getFormConf(true, false, false))
            ->add('roles', ChoiceType::class, [
                'label' => 'Roles',
                'mapped' => true,
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Élève' => 'ROLE_STUDENT',
                    'Parent' => 'ROLE_PARENT',
                    'Administrateur' => 'ROLE_ADMIN',
                    'Secrétaire' => 'ROLE_SECRETARY',
                    'Directeur' => 'ROLE_DIRECTOR',
                    'CPE' => 'ROLE_CPE',
                    'Administration' => 'ROLE_ADMINISTRATION',
                    'Professeur' => 'ROLE_PROFESSOR',
                    'Intervenant' => 'ROLE_CONTRIBUTOR',
                    'Autre' => 'ROLE_OTHER',
                ],
            ])
            ->add('password', PasswordType::class, $this->getFormConf(true, false, false))
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
            ->add('type', ChoiceType::class, [
                'placeholder' => false,
                'label' => false,
                'required' => true,
                'choices' => [
                    'Parent' => 'Parent',
                    'Élève' => 'Student',
                    'Administraeur' => 'Administrator',
                    'Administration' => 'Administration',
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
