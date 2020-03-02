<?php

class Model
{
    /**
     * Model valide
     * @var bool
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
            if ( !$ignore )
            {
                if ( !$this->validField( $Validation ) )
                    $this->IsValid = false;
            }
            
            $property = $Validation[ 'name' ];
            $value = $this->getPost( $Validation );

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
    function getPost( array $fields )
    {
        $name       = $fields[ 'name' ] ?? null;
        $type       = $fields[ 'type' ] ?? null;

        if ( $type != 'checkbox' )
        {
            if ( isset( $_POST[ $name ] ) )
                if ( !empty( $_POST[ $name ] ) )
                    return $_POST[ $name ];

            return NULL;
        }

        return isset( $_POST[ $name ] );
    }

    /**
     * 
     * Vérifie la validité des champs
     * 
     * @param string  $fields       Attribut du champs
     * 
     */
    private function validField( array $fields )
    {
        $min        = $fields[ 'min' ] ?? null;
        $minlength  = $fields[ 'minlength' ] ?? null;
        $max        = $fields[ 'max' ] ?? null;
        $maxlength  = $fields[ 'maxlength' ] ?? null;
        $type       = $fields[ 'type' ] ?? null;
        $require    = array_key_exists( 'required', $fields );
        $value      = null;

        if ( isset( $_POST[ $fields[ 'id' ] ] ) )
            $value = $_POST[ $fields[ 'id' ] ];

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
                        $this->Validations[ $fields[ 'id' ] ][ 'Error' ] = "Ce champ est obligatoire.";
                        return false;
                    }
                break;

                case 'number':
                case 'checkbox':
                    if ( intval( $value ) == 0 )
                    {
                        $this->Validations[ $fields[ 'id' ] ][ 'Error' ] = "Ce champ est obligatoire.";
                        return false;
                    }
                break;
            };
        }

        if ( $minlength && $value )
        {
            if ( strlen( $value) < $minlength )
            {
                $this->Validations[ $fields[ 'id' ] ][ 'Error' ] = "Veuillez fournir au moins $minlength caractères.";
                return false;
            }
        }

        if ( $maxlength && $value )
        {
            if ( strlen( $value) > $maxlength )
            {
                $this->Validations[ $fields[ 'id' ] ][ 'Error' ] = "Veuillez fournir au plus $maxlength caractères.";
                return false;
            }
        }

        if ( $min )
        {
            if ( intval( $value) < $min )
            {
                $this->Validations[ $fields[ 'id' ] ][ 'Error' ] = "Veuillez fournir une valeur supérieure ou égale à $min.";
                return false;
            }
        }

        if ( $max )
        {
            if ( intval( $value) < $max )
            {
                $this->Validations[ $fields[ 'id' ] ][ 'Error' ] = "Veuillez fournir une valeur inférieure ou égale à $min.";
                return false;
            }
        }

        if ( $type && $value )
        {
            if ( $type == 'numeric' && !is_numeric( $value ) )
            {
                $this->Validations[ $fields[ 'id' ] ][ 'Error' ] = "Veuillez fournir seulement des chiffres.";
                return false;
            }

            if ( $type == 'date' && !$this->validateDate( $value ) )
            {
                $this->Validations[ $fields[ 'id' ] ][ 'Error' ] = "Veuillez fournir une date valide.";
                return false;
            }

            if ( $type == 'email' && !filter_var( $value, FILTER_VALIDATE_EMAIL ) )
            {
                $this->Validations[ $fields[ 'id' ] ][ 'Error' ] = "Veuillez fournir une adresse électronique valide.";
                return false;
            }

            if ( $type == 'url' && !filter_var( $value, FILTER_VALIDATE_URL ) )
            {
                $this->Validations[ $fields[ 'id' ] ][ 'Error' ] = "Veuillez fournir une adresse URL valide.";
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