<?php

include_once CORE. "/model.php";

class EditModel extends Model
{
    /**
     * Civilite (Require)
     * @var string $Civilite
     */
    public $Civilite;

    /**
     * Prenom
     * @var string $Prenom
     */
    public $Prenom;

    /**
     * Nom
     * @var string $Nom
     */
    public $Nom;

    /**
     * Ville
     * @var string $Ville
     */
    public $Ville;

    /**
     * Adresse
     * @var string $Adresse
     */
    public $Adresse;

    /**
     * Code Postal
     * @var string $CodePostal
     */
    public $CodePostal;

    /**
     * Pays id
     * @var int $Pays
     */
    public $Pays;

    /**
     * Fields validations
     */
    public $Validations = array
    (
        'Civilite' => [ 
            'type'          => 'text',
            'id'            => 'Civilite',
            'name'          => 'Civilite',
            'class'         => 'form-control',
            'placeholder'   => 'Civilité *', 
            'required'      => ''
        ],

        'Prenom' => [
            'type'          => 'text',
            'id'            => 'Prenom',
            'name'          => 'Prenom',
            'placeholder'   => 'Prénom *', 
            'maxlength'     => '70',
            'class'         => 'form-control', 
            'required'      => ''
        ],

        'Nom' => [
            'type'          => 'text',
            'id'            => 'Nom',
            'name'          => 'Nom',
            'placeholder'   => 'Nom *', 
            'maxlength'     => '100',
            'class'         => 'form-control', 
            'required'      => ''
        ],

        'Adresse' => [
            'type'          => 'text',
            'id'            => 'Adresse',
            'name'          => 'Adresse',
            'placeholder'   => 'Adresse',
            'maxlength'     => '200', 
            'class'         => 'form-control'
        ],

        'Ville' => [ 
            'type'          => 'text',
            'id'            => 'Ville',
            'name'          => 'Ville',
            'placeholder'   => 'Ville', 
            'maxlength'     => '200', 
            'class'         => 'form-control'
        ],

        'CodePostal' => [
            'type'          => 'text',
            'id'            => 'CodePostal',
            'name'          => 'CodePostal',
            'placeholder'   => "Code postal",
            'minlength'     => '5',
            'maxlength'     => '5',
            'class'         => 'form-control'
        ],

        'Pays' => [ 
            'type'          => 'number',
            'id'            => 'Pays',
            'name'          => 'Pays',
            'placeholder'   => 'Pays', 
            'class'         => 'form-control'
        ]
    );

    public $civilites = [ 'Monsieur', 'Mademoiselle', 'Madame' ];

    function customCiviliteValidation( array $field, $value )
    {
        if ( !in_array( $value, $this->civilites ) )
        {
            $this->Validations[ $field[ 'id' ] ][ 'Error' ] = "Cette civilité n'est pas valide.";
            return false;
        }

        return true;
    }

    public function Parse( object $user )
    {
        $this->Civilite = $user->civilite;
        $this->Prenom = $user->prenom;
        $this->Nom = $user->nom;
        $this->Ville = $user->ville;
        $this->Adresse = $user->adresse;
        $this->CodePostal = $user->codePostal;
        $this->Pays = $user->pays_id;
    }
}

?>