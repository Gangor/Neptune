<?php

require CORE. "/users.php";

class Controller
{
    var $view = [];
    var $section = [];
    var $user;

    public function __construct()
    {
        if ( Session::Loggin() ) 
        {
            $users = new Users();
            $userId = Session::get( 'userId' );
            $user = $users->GetUserById( $userId );
            
            $this->view[ 'user' ] = $user;
            $this->user = $user;
        }
        
        $this->view[ 'error' ] = "";
    }

    function render( string $action_name, string $layout = "default")
    {
        extract( $this->view );

        ob_start();

        $controller = strtolower( str_replace( 'Controller', '', get_class( $this ) ) );
        $file = VIEWS. '/'. $controller .'/'. $action_name .'.php';

        if ( !is_file( $file ) )
            throw new Exception( 'View not found !!!' );

        require( $file );

        $this->section["body"] = ob_get_clean();

        if ( $layout )
        {
            $file = VIEWS. '/layouts/'. $layout .'.php';

            if ( !is_file( $file ) )
                throw new Exception( 'Layout not found !!!');
            
            require( $file );
        }
    }

    function renderSection( $name )
    {
        if ( isset( $this->section[ $name ] ) )
        {
            extract( $this->view );
            echo $this->section[ $name ];
        }
    }

    function renderPartial( $file )
    {
        if ( !is_file( $file ) )
            echo 'Partial not found !!!';

        extract( $this->view );
        require( $file );
    }

    function getPost( string $name )
    {
        if ( isset( $_POST[ $name ] ) )
            if ( !empty( $_POST[ $name ] ) )
                return $_POST[ $name ];

        return NULL;
    }

    function validPosts( array $names )
    {
        foreach ( $names as $name )
        {
            if ( !isset( $_POST[ $name ] ) || empty( $_POST[ $name ] ) )
                return false;
        }
        return true;
    }

    function validPost( string $name, string $type, int $min, int $max, bool $required )
    {
        if ( ( !isset( $_POST[ $name ] ) || empty( $_POST[ $name ] ) ) && !$required )
            return true;
        elseif ( ( !isset( $_POST[ $name ] ) || empty( $_POST[ $name ] ) ) && $required )
            return false;
        
        switch ( $type )
        {
            case 'password':
            case 'text':
                if ( strlen( $_POST[ $name ] ) < $min || strlen( $_POST[ $name ] ) > $max )
                    return false;
            break;

            case 'number':
                if ( $_POST[ $name ] < $min && $min != -1 || $_POST[ $name ] > $max && $max != -1 )
                    return false;
            break;

            case 'email': 
                if ( !filter_var( $_POST[ $name ], FILTER_VALIDATE_EMAIL )) 
                    return false;
            break;

            case 'date':
                if ( !$this->validateDate( $_POST[ $name ] ) )
                    return false;
            break;
        } 

        return true;
    }

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    /**
     * HTTP Error
     */

    function invalid()          { $this->statusCode( 400, 'Invalid argument' ); }
    function unauthorized()     { $this->statusCode( 401, 'Unauthorized' );     }
    function not_found()        { $this->statusCode( 404, 'Not Found' );        }

    function statusCode( int $code, string $message )
    {
        header( $_SERVER['SERVER_PROTOCOL'] .' '. $code .' '. $message );
        exit();
    }
}

?>