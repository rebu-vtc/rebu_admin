<?php

namespace App\Form\FormConfig;

use Symfony\Component\Form\AbstractType;

class FormConfig extends AbstractType
{
    protected function getProfessions(): array
    {
        return [
            'Technicien' => 'Technicien',
            'Assistant(e) médical' => 'Assistant(e) médical',
            'Agent dans la fonction public' => 'Agent dans la fonction public',
            'Informaticien' => 'Informaticien',
            'Chauffeur' => 'Chauffeur',
            'Commerçant' => 'Commerçant',
            'Directeur d\'école' => 'Directeur d\'école',
            'Enseignant' => 'Enseignant',
            'Sans intérêt' => 'Sans intérêt',
            'Autre' => 'Autre',
            // à compléter
        ];
    }

    protected function getStudentLinks(): array
    {
        return [
            'Père' => 'Père',
            'Mère' => 'Mère',
            'Frère' => 'Frère',
            'Soeur' => 'Soeur',
            'Cousin' => 'Cousin',
            'Cousine' => 'Cousine',
            'Ami(e) de la famille' => 'Ami(e) de la famille',
            'Autre' => 'Autre',
            // à compléter
        ];
    }

    protected function getFamilySituations(): array
    {
        return [
            'Célibataire' => 'Célibataire',
            'Marié' => 'Marié',
            'Pacsé' => 'Pacsé',
            'Concubinage' => 'Concubinage',
            'Foyer sans enfant' => 'Foyer sans enfant',
            'Foyer avec enfant(s)' => 'Foyer avec enfant()',
            'Parent isolé' => 'Parent isolé',
            'Autre' => 'Autre',
            // à compléter
        ];
    }

    /**
     * The default configuration of a field.
     *
     * @param bool        $required
     * @param bool|string $label
     * @param bool|string $placeholder
     * @param array       $options
     */
    protected function getFormConf($required, $label, $placeholder, $options = []): array
    {
        return array_merge([
            'required' => $required,
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder,
            ],
        ], $options);
    }
}
