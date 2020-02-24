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
        if ( isset( $result ) &&
            !empty( $result ) )
            return $_SESSION[ $name];
        
        return null;
    }

    static function Loggin()
    {
        return Session::get('userId') !== null;
    }

    static function set( string $name, $value )
    {
        $_SESSION[ $name] = $value;
    }
}

?>