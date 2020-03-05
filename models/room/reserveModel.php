<?php

include_once CORE. "/model.php";

class ReserveModel extends Model
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
            'required'      => ''
        ],
        
        'Fin' => [ 
            'type'          => 'date',
            'id'            => 'Fin',
            'name'          => 'Fin',
            'placeholder'   => 'Date de fin',
            'greaterThan'   => '#Debut',
            'class'         => 'form-control',
            'required'      => ''
        ]
    );
}

?>