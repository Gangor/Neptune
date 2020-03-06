<?php

include_once CORE. "/model.php";

class BuyModel extends Model
{
    /**
     * Nom complet (Require)
     * @var string $Nom
     */
    public $Nom;

    /**
     * Numero (Require)
     * @var string $Numero
     */
    public $Numero;

    /**
     * Mois (Require)
     * @var string $Mois
     */
    public $Mois;

    /**
     * Annee (Require)
     * @var string $Annee
     */
    public $Annee;

    /**
     * Cryptogramme (Require)
     * @var string $Cryptogramme
     */
    public $Cryptogramme;

    /**
     * Fields validations
     */
    public $Validations = array
    (
        'Nom' => [
            'type'          => 'text',
            'id'            => 'Nom',
            'name'          => 'Nom',
            'placeholder'   => 'Nom complet du titulaire de la carte *', 
            'maxlength'     => '100',
            'class'         => 'form-control',
            'required'      => ''
        ],

        'Numero' => [
            'type'          => 'number',
            'id'            => 'Numero',
            'name'          => 'Numero',
            'placeholder'   => 'Numéro de la carte *',
            'maxlength'     => '16',
            'class'         => 'form-control',
            'required'      => ''
        ],

        'Mois' => [
            'type'          => 'number',
            'id'            => 'Mois',
            'name'          => 'Mois',
            'placeholder'   => "Mois *",
            'min'           => '1',
            'max'           => '12',
            'class'         => 'form-control', 
            'required'      => ''
        ],

        'Annee' => [
            'type'          => 'number',
            'id'            => 'Annee',
            'name'          => 'Annee',
            'placeholder'   => 'Année *',
            'min'           => YEAR,
            'class'         => 'form-control', 
            'required'      => ''
        ],

        'Cryptogramme' => [ 
            'type'          => 'number',
            'id'            => 'Cryptogramme',
            'name'          => 'Cryptogramme',
            'placeholder'   => 'Cryptogramme *',
            'minlength'     => '3', 
            'maxlength'     => '3', 
            'class'         => 'form-control', 
            'required'      => ''
        ]
    );
}

?>