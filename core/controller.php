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
     * @param       string $layout      Habillage de la page
     * 
     */
    public function render( string $viewname, string $layout = "default")
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
    function renderPartial( string $file )
    {
        if ( !is_file( $file ) )
            echo 'Partial not found !!!';

        extract( $this->view );
        require( $file );
    }

    /**
     * 
     * Récupére la valeur d'un post
     * 
     * @param       string $name    Clef de l'array
     * @return      string
     * 
     */
    function getPost( string $name )
    {
        if ( isset( $_POST[ $name ] ) )
            if ( !empty( $_POST[ $name ] ) )
                return $_POST[ $name ];

        return NULL;
    }

    /**
     * 
     * Vérifie la validité de plusieurs post (Basique)
     * 
     * @param       array $names    Clefs de l'array
     * @return      bool
     * 
     */
    function validPosts( array $names )
    {
        foreach ( $names as $name )
        {
            if ( !isset( $_POST[ $name ] ) || empty( $_POST[ $name ] ) )
                return false;
        }
        return true;
    }

    /**
     * 
     * Vérifie la validité d'un post (Avancé)
     * 
     * @param       string  $name       Clef de l'array
     * @param       string  $type       Type de donnée
     * @param       int     $min        Taille minimum
     * @param       int     $max        Taille maximum
     * @param       bool    $required   Requis
     * @return      bool
     * 
     */
    function validPost( string $name, string $type, int $min, int $max, bool $required )
    {
        if ( ( !isset( $_POST[ $name ] ) || empty( $_POST[ $name ] ) ) && !$required )
            return true;
        elseif ( ( !isset( $_POST[ $name ] ) || empty( $_POST[ $name ] ) ) && $required )
            return false;
        
        switch ( $type )
        {
            case 'text':
            case 'password':
                if ( strlen( $_POST[ $name ] ) < $min && $min != -1 || 
                     strlen( $_POST[ $name ] ) > $max && $max != -1 )
                    return false;
            break;

            case 'number':
                if ( $_POST[ $name ] < $min && $min != -1 || 
                     $_POST[ $name ] > $max && $max != -1 )
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