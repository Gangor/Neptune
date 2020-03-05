<?php

include_once CORE. "/model.php";

class ReserveConfirmModel extends Model
{
    /**
     * Date de début (requis)
     * @var string $Debut
     */
    public $Debut;

    /**
     * Date de fin (requis)
     * @var string $Debut
     */
    public $Fin;

    /**
     * Validation du choix (requis)
     * @var bool $Valider
     */
    public $Valider;

    /**
     * Fields validations
     */
    public $Validations = array
    (
        'Debut' => [ 
            'type'          => 'date',
            'id'            => 'Debut',
            'name'          => 'Debut',
            'placeholder'   => 'Date de début',
            'class'         => 'form-control',
            'readonly'      => '',
            'required'      => ''
        ],
        
        'Fin' => [ 
            'type'          => 'date',
            'id'            => 'Fin',
            'name'          => 'Fin',
            'placeholder'   => 'Date de fin',
            'greaterThan'   => '#Debut',
            'class'         => 'form-control',
            'readonly'      => '',
            'required'      => ''
        ],
        
        'Valider' => [ 
            'type'          => 'checkbox',
            'id'            => 'Valider',
            'name'          => 'Valider',
            'placeholder'   => 'Je suis sur de mon choix',
            'class'         => 'form-check-input',
            'required'      => ''
        ]
    );
}

?>