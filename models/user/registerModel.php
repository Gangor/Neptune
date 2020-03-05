<?php

include_once CORE. "/model.php";

class RegisterModel extends Model
{
    /**
     * Email (Require)
     * @var string $email
     */
    public $Email;

    /**
     * Password (Require)
     * @var string $email
     */
    public $Password;

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
     * Adresse
     * @var string $Adresse
     */
    public $Adresse;

    /**
     * Ville
     * @var string $Ville
     */
    public $Ville;

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
        'Email' => [
            'type'          => 'email',
            'id'            => 'Email',
            'name'          => 'Email',
            'maxlength'     => '60',
            'placeholder'   => 'Email *',
            'class'         => 'form-control',
            'required'      => ''
        ],

        'Password' => [ 
            'type'          => 'password',
            'id'            => 'Password',
            'name'          => 'Password',
            'maxlength'     => '50', 
            'placeholder'   => 'Mot de passe *', 
            'class'         => 'form-control', 
            'required'      => ''
        ],

        'Civilite' => [ 
            'type'          => 'text',
            'id'            => 'Civilite',
            'name'          => 'Civilite',
            'class'         => 'form-control',
            'placeholder'   => "Civilité",
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
            'placeholder'   => "Pays",
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
}

?>