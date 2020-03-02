<?php

class Session
{
    /**
     * 
     * Initialise une instance session
     * Démarre la session
     * 
     */
    function __construct()
    {
        session_start();
    }

    /**
     * 
     * Détruit la session
     * 
     */
    static function destroy()
    {
        session_destroy();
    }

    /**
     * 
     * Récupére la valeur d'une clef session
     * 
     * @param   string $name    Clef de session
     * 
     */
    static function get( string $name )
    {        
        if ( isset( $_SESSION[ $name ] ) && !empty( $_SESSION[ $name ] ) )
            return $_SESSION[ $name];
        
        return false;
    }

    /**
     * 
     * Vérifie si l'utilisateur est connecté
     * 
     */
    static function Loggin()
    {
        return Session::get( 'userId' ) != false;
    }

    /**
     * 
     * Ajoute ou modifie une valeur dans la session
     * 
     * @param   string $name    Clef session
     * @param   string $value   Valeur à attribuer
     * 
     */
    static function set( string $name, string $value )
    {
        $_SESSION[ $name ] = $value;
    }
}

?>