<?php

require ROOT. "/core/users.php";

class Controller
{
    var $view = [];
    var $section = [];
    var $user;

    function __construct()
    {
        $this->user = new Users();

        if ( Session::Loggin() ) 
        {
            $userId = Session::get( 'userId' );
            $user = $this->user->GetUser( $userId );
            
            $this->view[ 'user' ] = $user;
        }
    }

    function render( string $action_name, string $layout = "default")
    {
        extract( $this->view );

        ob_start();

        $file = ROOT. 'views/' .strtolower( str_replace( 'Controller', '', get_class( $this ) ) ). '/' .$action_name. '.php';

        if ( !is_file( $file ) )
            throw new Exception( 'View not found !!!' );

        require( $file );

        $this->section["body"] = ob_get_clean();

        if ( $layout )
        {
            $file = ROOT. 'views/layouts/' .$layout. '.php';

            if ( !is_file( $file ) )
                throw new Exception( 'Layout not found !!!');
            
            require( $file );
        }
    }

    /**
     * HTTP Error
     */

    function invalid()          { $this->statusCode( 400, 'Invalid argument' ); }
    function unauthorized()     { $this->statusCode( 401, 'Unauthorized' );     }
    function not_found()        { $this->statusCode( 404, 'Not Found' );        }

    function statusCode( int $code, string $message )
    {
        header( $_SERVER['SERVER_PROTOCOL'].' '.$code.' '.$message );
        exit();
    }
}

?>