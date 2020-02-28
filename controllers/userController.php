<?php

require ROOT. "/core/controller.php";

class userController extends Controller
{
    public function login()
    {
        $this->render("login");
    }

    public function loginconfirm()
    {
        if ( $this->validPosts( array( 'email', 'password' ) ) )
        {
            $email      = $this->getPost( "email" );
            $user       = $this->user->GetUserByEmail( $email );
            $password   = $_POST[ "password" ];

            if ( $user != null)
            {
                if ( sha1( $password ) == $user->motdepasse )
                {
                    Session::set( 'userId', $user->id );
                    Router::redirect( '' );
                    return;
                }
            }
            
            $this->view["error"] = "Identifiant ou mot de passe incorrect.";
        }
        else $this->view["error"] = "Un ou plusieurs champs manquant.";

        $this->render("login");
    }

    public function logout()
    {
        if ($this->user)
        {
            Session::destroy();
            Router::redirect( '' );
        }
    }

    public function register()
    {
        $this->view["pays"] = $this->user->GetPays();
        $this->render("register");
    }

    public function registerconfirm()
    {
        if ( $this->validPosts( array( 'email', 'password', 'civilite', 'pays', 'firstname', 'lastname', 'adresse', 'ville', 'codepostal' ) ) )
        {
            $email      = $this->getPost( "email" );
            $password   = $this->getPost( "password" );
            $civilite   = $this->getPost( "civilite" );
            $lastname   = $this->getPost( "lastname" );
            $firstname  = $this->getPost( "firstname" );
            $adresse    = $this->getPost( "adresse" );
            $codepostal = $this->getPost( "codepostal" );
            $ville      = $this->getPost( "ville" );
            $pays       = intval( $this->getPost( "pays" ) );

            if ( $this->user->GetUserByEmail( $email ) == null )
            {
                if ( $this->user->Create( $email, $password, $civilite, $lastname, $firstname, $adresse, $codepostal, $ville, $pays ) )
                    Router::redirectLocal( 'user', 'login' );
            }
            else $this->view["error"] = "Cette adresse mail est déjà utilisé.";
        }
        else $this->view["error"] = "Un ou plusieurs champs manquant.";

        $this->view["pays"] = $this->user->GetPays();
        $this->render("register");
    }
}

?>