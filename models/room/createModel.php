<?php

include_once CORE. "/model.php";

class createModel extends Model
{
    /**
     * Capacité (Require)
     * @var int $Capacite
     */
    public $Capacite;

    /**
     * Exposition (Require)
     * @var string $Exposition
     */
    public $Exposition;

    /**
     * Douche
     * @var bool $Douche
     */
    public $Douche;

    /**
     * Etage (Require)
     * @var int $Etage
     */
    public $Etage;

    /**
     * Tarif (Require)
     * @var int $Tarif
     */
    public $Tarif;

    /**
     * Fields validations
     */
    public $Validations = array
    (
        'Capacite' => [ 
            'type'          => 'number',
            'id'            => 'Capacite',
            'name'          => 'Capacite',
            'min'           => 1,
            'placeholder'   => 'Capacité *', 
            'class'         => 'form-control', 
            'required'      => ''
        ],

        'Exposition' => [ 
            'type'          => 'text',
            'id'            => 'Exposition',
            'name'          => 'Exposition',
            'maxlength'     => 100,
            'placeholder'   => 'Exposition *', 
            'class'         => 'form-control', 
            'required'      => ''
        ],

        'Douche' => [ 
            'type'          => 'checkbox',
            'id'            => 'Douche',
            'name'          => 'Douche',
            'placeholder'   => 'Douche *',
            'class'         => 'form-check-input'
        ],

        'Etage' => [ 
            'type'          => 'number',
            'id'            => 'Etage',
            'name'          => 'Etage',
            'min'           => 1,
            'placeholder'   => 'Etage *', 
            'class'         => 'form-control', 
            'required'      => ''
        ],

        'Tarif' => [ 
            'id'            => 'Tarif',
            'name'          => 'Tarif',
            'placeholder'   => 'Tarif (€) *',
            'class'         => 'form-control', 
            'required'      => ''
        ],
    );

    public function Parse( object $room )
    {
        $this->Capacite = $room->capacite;
        $this->Exposition = $room->exposition;
        $this->Douche = $room->douche;
        $this->Etage = $room->etage;
        $this->Tarif = $room->tarif_id;
    }
}

?>