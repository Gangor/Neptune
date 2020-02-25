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
            $user = $this->user->GetUserByEmail( $_POST[ "email" ] );
            $password = $_POST[ "password" ];

            if ( sha1( $password ) == $user->motdepasse )
            {
                echo "yessss";
                Session::set( 'userId', $user->id );
                Router::redirect( '' );
                return;
            }
        }

        Router::redirectLocal( 'User', 'login' );
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
            if ( $this->user->Create( $_POST[ "email" ], $_POST[ "password" ], $_POST[ "civilite" ], $_POST[ "lastname" ], $_POST[ "firstname" ], $_POST[ "adresse" ], $_POST[ "codepostal" ], $_POST[ "ville" ], intval( $_POST[ "pays" ] ) ) )
            {
                Router::redirectLocalWithParams( 'User', 'register', array( "1" ) );
            }
        }
    }
}

?>