<?php

require CORE. "/controller.php";

class userController extends Controller
{
    private $users;

    public function __construct()
    {
        $this->users = new Users();
    }

    /*
     * GET : /user/login
     */
    public function login( string $url = "" )
    {
        $this->view["url"] = $url;
        $this->render("login");
    }

    /*
     * POST : /user/login
     */
    public function loginconfirm( string $url = "" )
    {
        if ( $this->validPosts( array( 'email', 'password' ) ) )
        {
            $email      = $this->getPost( "email" );
            $user       = $this->users->GetUserByEmail( $email );
            $password   = $_POST[ "password" ];

            if ( $user == null)          $this->view["error"] = "Identifiant ou mot de passe incorrect.";
            else if ( !$user->confirme ) $this->view["error"] = "Ce compte n'a pas été activé.";            
            else
            {
                if ( sha1( $password ) == $user->motdepasse )
                {
                    Session::set( 'userId', $user->id );
                    Router::redirect( $url );
                }
                else $this->view["error"] = "Identifiant ou mot de passe incorrect.";
            }
        }
        else $this->view["error"] = "Un ou plusieurs champs manquant.";

        $this->view["url"] = $url;
        $this->render("login");
    }

    /*
     * GET : /user/logout
     */
    public function logout()
    {
        if ( $this->user )
        {
            Session::destroy();
            Router::redirect( '' );
        }
    }

    /*
     * GET : /user/register
     */
    public function register()
    {
        $this->view["pays"] = $this->users->GetPays();
        $this->render("register");
    }

    /*
     * POST : /user/registerconfirm
     */
    public function registerconfirm()
    {
        if ( $this->validPosts( array( 'email', 'password', 'civilite', 'pays', 'firstname', 'lastname', 'adresse', 'ville', 'codepostal' ) ) )
        {
            $email = $this->getPost( "email" );

            // Exist user ?
            if ( $this->users->GetUserByEmail( $email ) == null )
            {
                $newUser = array(
                    'civilite'      => $this->getPost( "civilite" ),
                    'nom'           => $this->getPost( "firstname" ),
                    'prenom'        => $this->getPost( "lastname" ),
                    'codePostal'    => $this->getPost( "codepostal" ),
                    'adresse'       => $this->getPost( "adresse" ),
                    'ville'         => $this->getPost( "ville" ),
                    'pays'          => intval( $this->getPost( "pays" ) ),
                    'identifiant'   => $email,
                    'motdepasse'    => sha1( $this->getPost( "password" ) ),
                    'cle'           => uniqid(),
                    'confirme'      => false,
                    'admin'         => null
                );
                
                if ( $this->users->Create( $newUser ) )
                {
                    Router::redirectLocal( 'user', 'login' );
                }
                else $this->view["error"] = "Une erreur ses produite lors de la création du compte.";
            }
            else $this->view["error"] = "Cette adresse mail est déjà utilisé.";
        }
        else $this->view["error"] = "Un ou plusieurs champs manquant.";

        $this->view["pays"] = $this->users->GetPays();
        $this->render("register");
    }

    public function manage()
    {
        if ( $this->user )
        {
            
        }

        $this->unauthorized();
    }
}

?>