<?php

require CORE. "/users.php";

class Controller
{
    /**
     * Objet partagé avec les vues (partiel, principal)
     * @var array $view
     */
    public $view = [];
    
    /**
     * Partage de contenue entre les vues (partiel, principal)
     * @var array $section
     */
    public $section = [];

    /**
     * Utilisateur actuel
     * @var object $user
     */
    public $user = null;

    /**
     * 
     * Initialisation de l'instance controller
     * 
     */
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

    /**
     * 
     * Démarre le rendu de la page
     * 
     * @param       string $viewname    Nom du fichier de la vue
     * @param       string $model       Modèle de la vue
     * @param       string $layout      Habillage de la page
     * 
     */
    public function render( string $viewname, object $model = null, string $layout = "default")
    {
        extract( $this->view );

        ob_start();

        $controller = strtolower( str_replace( 'Controller', '', get_class( $this ) ) );
        $file = VIEWS. '/'. $controller .'/'. $viewname .'.php';

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

    /**
     * 
     * Imprime le contenue d'une section en sortie standard
     * 
     * @param       string $name    Nom de la section
     * 
     */
    function renderSection( string $name )
    {
        if ( isset( $this->section[ $name ] ) )
        {
            extract( $this->view );
            echo $this->section[ $name ];
        }
    }

    /**
     * 
     * Imprime le contenue d'un fichier complémentaire en sortie standard
     * 
     * @param       string $file    Emplacement du fichier à inclure
     * 
     */
    function renderPartial( string $file, object $model = null )
    {
        if ( !is_file( $file ) )
            echo 'Partial not found !!!';

        extract( $this->view );
        require( $file );
    }

    /**
     * HTTP Error
     */

    /** 
     * Renvoi une erreur 400 et quitte l'execution en cours
    */
    function invalid()          { $this->statusCode( 400, 'Invalid argument' ); }

    /** 
     * Renvoi une erreur 401 et quitte l'execution en cours
    */
    function unauthorized()     { $this->statusCode( 401, 'Unauthorized' );     }

    /** 
     * Renvoi une erreur 404 et quitte l'execution en cours
    */
    function not_found()        { $this->statusCode( 404, 'Not Found' );        }

    /**
     * 
     * Renvoi un code erreur et quitte l'execution en cours
     * 
     * @param   int $code           Code erreur
     * @param   string $message     Message d'erreur
     * 
     */
    function statusCode( int $code, string $message )
    {
        header( $_SERVER['SERVER_PROTOCOL'] .' '. $code .' '. $message );
        exit();
    }
}

?>