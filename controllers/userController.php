<?php

require CORE. "/controller.php";

require MODELS. "/user/loginModel.php";
require MODELS. "/user/registerModel.php";

class userController extends Controller
{
    private $users;

    public function __construct()
    {
        $this->users = new Users();
    }

    /*
     *
     * GET : /user/login/{redirect}
     * Page d'authentification
     * 
     * @param   string $redirect    Lien de redirection
     * 
     */
    public function login( string $redirect = '' )
    {
        $model = new LoginModel( true );

        $this->view[ 'url' ] = $redirect;
        $this->render( 'login', $model );
    }

    /*
     *
     * POST : /user/login/{redirect}
     * Page de confirmation d'authentification
     * 
     * @param   string $redirect    Lien de redirection
     * 
     */
    public function loginconfirm( string $redirect = '' )
    {
        $model = new LoginModel();

        if ( $model->IsValid )
        {
            $user = $this->users->GetUserByEmail( $model->Email );

            if ( $user != null)
            {
                if ( $user->motdepasse == sha1( $model->Password ) )
                {
                    if ( $user->confirme )
                    {
                        Session::set( 'userId', $user->id );
                        Router::redirect( $redirect );
                    }
                    else $this->view[ 'error' ] = 'Ce compte n\'a pas été activé.';
                }
                else $this->view[ 'error' ] = 'Identifiant ou mot de passe incorrect.';
            }
            else $this->view[ 'error' ] = 'Identifiant ou mot de passe incorrect.';
        }
        else $this->view[ 'error' ] = 'Un ou plusieurs champs ne sont pas correctement remplis.';

        $this->view[ 'url' ] = $redirect;        
        $this->render( 'login', $model );
    }

    /*
     *
     * GET : /user/logout
     * Page de déconnexion
     * 
     */
    public function logout()
    {
        if ( !$this->user )
            $this->unauthorized();
            
        Session::destroy();
        Router::redirect( '' );
    }

    /*
     *
     * GET : /user/register
     * Page d'inscription
     * 
     */
    public function register()
    {
        $model = new registerModel( true );
        
        $this->view[ 'pays' ] = $this->users->GetPays();
        $this->render( 'register', $model );
    }

    /*
     *
     * POST : /user/registerconfirm
     * Page de confirmation d'inscription
     * 
     */
    public function registerconfirm()
    {
        $model = new registerModel();
        
        if ( $model->IsValid )
        {
            // Exist user ?
            if ( !$this->users->GetUserByEmail( $model->Email ) )
            {
                $newUser = new stdClass();

                $newUser->civilite      = $model->Civilite;
                $newUser->nom           = $model->Nom;
                $newUser->prenom        = $model->Prenom;
                $newUser->codePostal    = $model->CodePostal;
                $newUser->adresse       = $model->Adresse;
                $newUser->ville         = $model->Ville;
                $newUser->pays_id       = (int)$model->Pays;
                $newUser->identifiant   = $model->Email;
                $newUser->motdepasse    = sha1( $model->Password );
                $newUser->cle           = uniqid();
                $newUser->confirme      = true;
                $newUser->admin         = null;
                
                if ( $this->users->Create( $newUser ) )
                {
                    Router::redirectLocal( 'user', 'login' );
                }
                else $this->view[ 'error' ] = 'Une erreur ses produite lors de la création du compte.';
            }
            else $this->view[ 'error' ] = 'Cette adresse mail est déjà utilisé.';
        }
        else $this->view[ 'error' ] = 'Un ou plusieurs champs ne sont pas correctement remplis.';

        $this->view[ 'pays' ] = $this->users->GetPays();
        $this->render( 'register', $model );
    }
}

?>