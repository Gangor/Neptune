<?php

class Model
{
    /**
     * Erreur générale
     * @var bool $Error
     */
    public $Error;

    /**
     * Model valide
     * @var bool $IsValid
     */
    public $IsValid = true;

    /**
     * Validation de champs
     * @var array
     */
    protected $Validations = array();

    function __construct( bool $ignore = false )
    {
        foreach ( $this->Validations as $Validation )
        {
            $property   = $Validation[ 'name' ];
            $value      = $this->getPost( $Validation );

            $this->Validations[ $Validation[ 'id' ] ][ 'Error' ] = '';
            
            if ( !$ignore )
            {
                $custom = 'custom'.$property.'Validation';

                if ( !$this->validField( $Validation, $value ) )
                    $this->IsValid = false;
                
                if ( method_exists( $this, $custom ))
                    if ( !call_user_func_array( [ $this, $custom ], array( $Validation, $value ) ) )
                        $this->IsValid = false;
            }

            $this->$property = $value;
        }
    }

    /**
     * 
     * Récupére la valeur d'un post
     * 
     * @param       string $name    Clef de l'array
     * @return      string
     * 
     */
    function getPost( array $field )
    {
        $name       = $field[ 'name' ] ?? null;
        $type       = $field[ 'type' ] ?? null;

        if ( $type == 'checkbox' )
        {
            return isset( $_POST[ $name ] );
        }
        else if ( $type == 'file' )
        {
            if ( isset( $_FILES[ $name ] ) )
                return $_FILES[ $name ];

            return NULL;
        }
        else
        {
            if ( isset( $_POST[ $name ] ) )
                if ( !empty( $_POST[ $name ] ) )
                    return $_POST[ $name ];

            return NULL;
        }
    }

    /**
     * 
     * Vérifie la validité des champs
     * 
     * @param string  $fields       Attribut du champs
     * @param var  $value           Vakye du champs
     * 
     */
    private function validField( array $field, $value )
    {
        $min        = $field[ 'min' ] ?? null;
        $minlength  = $field[ 'minlength' ] ?? null;
        $max        = $field[ 'max' ] ?? null;
        $maxlength  = $field[ 'maxlength' ] ?? null;
        $type       = $field[ 'type' ] ?? null;
        $require    = array_key_exists( 'required', $field );

        if ( $type != null && $require )
        {
            switch( $type )
            {
                case 'color':
                case 'date':
                case 'password':
                case 'email':
                case 'search':
                case 'text':
                case 'tel':
                case 'url':
                    if ( strlen( $value ) == 0 )
                    {
                        $this->Validations[ $field[ 'id' ] ][ 'Error' ] = "Ce champ est obligatoire.";
                        return false;
                    }
                break;

                case 'file':
                    if ( !$value )
                    {
                        $this->Validations[ $field[ 'id' ] ][ 'Error' ] = "Ce champ est obligatoire.";
                        return false;
                    }
                break;

                case 'number':
                case 'checkbox':
                    if ( intval( $value ) == 0 )
                    {
                        $this->Validations[ $field[ 'id' ] ][ 'Error' ] = "Ce champ est obligatoire.";
                        return false;
                    }
                break;
            };
        }

        if ( $minlength && $value )
        {
            if ( strlen( $value) < $minlength )
            {
                $this->Validations[ $field[ 'id' ] ][ 'Error' ] = "Veuillez fournir au moins $minlength caractères.";
                return false;
            }
        }

        if ( $maxlength && $value )
        {
            if ( strlen( $value) > $maxlength )
            {
                $this->Validations[ $field[ 'id' ] ][ 'Error' ] = "Veuillez fournir au plus $maxlength caractères.";
                return false;
            }
        }

        if ( $min )
        {
            if ( intval( $value ) < $min )
            {
                $this->Validations[ $field[ 'id' ] ][ 'Error' ] = "Veuillez fournir une valeur supérieure ou égale à $min.";
                return false;
            }
        }

        if ( $max )
        {
            if ( intval( $value ) > $max )
            {
                $this->Validations[ $field[ 'id' ] ][ 'Error' ] = "Veuillez fournir une valeur inférieure ou égale à $min.";
                return false;
            }
        }

        if ( $type && $value )
        {
            if ( $type == 'numeric' && !is_numeric( $value ) )
            {
                $this->Validations[ $field[ 'id' ] ][ 'Error' ] = "Veuillez fournir seulement des chiffres.";
                return false;
            }

            if ( $type == 'date' && !$this->validateDate( (string)$value ) )
            {
                $this->Validations[ $field[ 'id' ] ][ 'Error' ] = "Veuillez fournir une date valide.";
                return false;
            }

            if ( $type == 'email' && !filter_var( $value, FILTER_VALIDATE_EMAIL ) )
            {
                $this->Validations[ $field[ 'id' ] ][ 'Error' ] = "Veuillez fournir une adresse électronique valide.";
                return false;
            }

            if ( $type == 'url' && !filter_var( $value, FILTER_VALIDATE_URL ) )
            {
                $this->Validations[ $field[ 'id' ] ][ 'Error' ] = "Veuillez fournir une adresse URL valide.";
                return false;
            }
        }

        return true;
    }

    /**
     * 
     * Vérifie la validité d'une date
     * 
     * @param       string  $date       Date sous forme de chaine de caractère
     * @param       string  $format     Format de la date
     * @return      bool
     * 
     */
    function validateDate( string $date, string $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}

?>