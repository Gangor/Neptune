<?php

class Session
{
    function __construct()
    {
        ini_set('session.gc_maxlifetime', SESSION_TIMEOUT );

        session_set_cookie_params( SESSION_TIMEOUT );
        session_start();
    }

    static function destroy()
    {
        session_destroy();
    }

    static function get( string $name )
    {        
        if ( isset( $_SESSION[ $name ] ) && !empty( $_SESSION[ $name ] ) )
            return $_SESSION[ $name];
        
        return false;
    }

    static function Loggin()
    {
        return Session::get( 'userId' ) != false;
    }

    static function set( string $name, $value )
    {
        $_SESSION[ $name ] = $value;
    }
}

?>