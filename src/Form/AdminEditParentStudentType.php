<?php

namespace App\Form;

use App\Entity\ParentStudent;
use App\Form\FormConfig\FormConfig;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @SuppressWarnings("unused")
 */
class AdminEditParentStudentType extends FormConfig
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('profession', ChoiceType::class, [
                'placeholder' => false,
                'label' => false,
                'required' => true,
                'choices' => $this->getProfessions(),
            ])
            ->add('linkWithStudent', ChoiceType::class, [
                'placeholder' => false,
                'label' => false,
                'required' => true,
                'choices' => $this->getStudentLinks(),
            ])
            ->add('familySituation', ChoiceType::class, [
                'placeholder' => false,
                'label' => false,
                'required' => true,
                'choices' => $this->getFamilySituations(),
            ])
            ->add('isPayer', ChoiceType::class, [
                'placeholder' => false,
                'label' => false,
                'required' => true,
                'choices' => [
                    'Non' => false,
                    'Oui' => true,  // à compléter
                ],
            ])
            ->add('nbrDependentChildren', NumberType::class, $this->getFormConf(true, false, false))
            ->add('isMain', ChoiceType::class, [
                'placeholder' => false,
                'label' => false,
                'required' => true,
                'choices' => [
                    'Non' => false,
                    'Oui' => true,  // à compléter
                ],
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
                    'Autre' => 'Autre',  // à compléter
                ],
            ])
            ->add('students', EntityType::class, [
                'class' => 'App\Entity\Student',
                'label' => false,
                'choice_label' => 'getFullName',
                'required' => true,
                'expanded' => true,
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ParentStudent::class,
        ]);
    }
}
