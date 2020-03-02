<?php

require CORE. "/controller.php";

class manageController extends Controller
{
    private $users;

    public function __construct()
    {
        $this->users = new Users();
    }

    public function index()
    {
        if ( !$this->user )
            $this->unauthorized();
            
        $this->view["pays"] = $this->users->GetPays();
        $this->render("index");
    }

    public function editconfirm()
    {
        if ( !$this->user )
            $this->unauthorized();

        if ( $this->validPost( 'civilite', 'text', -1, 20, true ) &&
             $this->validPost( 'firstname', 'text', -1, 70, true ) &&
             $this->validPost( 'lastname', 'text', -1, 100, true ) && 
             $this->validPost( 'pays', 'number', -1, -1, false ) &&
             $this->validPost( 'adresse', 'text', -1, 200, false ) &&
             $this->validPost( 'ville', 'text', -1, 200, false ) &&
             $this->validPost( 'codepostal', 'text', 5, 5, false ) )
        {
            $this->user->civilite = $this->getPost( 'civilite' );
            $this->user->prenom = $this->getPost( 'firstname' );
            $this->user->nom = $this->getPost( 'lastname' );

            if ( !$this->user->admin )
            {
                $this->user->pays_id = $this->getPost( 'pays' );
                $this->user->adresse = $this->getPost( 'adresse' );
                $this->user->ville = $this->getPost( 'ville' );
                $this->user->codePostal = $this->getPost( 'codepostal' );
            }

            if ( $this->users->Update( $this->user ) )
            {
                $this->view[ "success" ] = true;
            }
            else $this->view["error"] = "Une erreur ses produite lors de l'édition du compte.";
        }
        else $this->view["error"] = "Un ou plusieurs champs ne sont pas correctement remplis.";

        $this->view["pays"] = $this->users->GetPays();
        $this->render("index");
    }

    public function editpassword()
    {            
        if ( !$this->user )
            $this->unauthorized();

        $this->render("editpassword");
    }

    public function editpasswordConfirm()
    {            
        if ( !$this->user )
            $this->unauthorized();

        if ( $this->validPost( 'oldpassword', 'password', -1, 50, true ) && 
             $this->validPost( 'newpassword', 'password', -1, 50, true ) && 
             $this->validPost( 'confirm', 'password', -1, 50, true ) )
        {
            $oldpassword = $this->getPost( 'oldpassword' );
            $newpassword = $this->getPost( 'newpassword' );
            $confirm = $this->getPost( 'confirm' );

            if ( $newpassword == $confirm )
            {
                if ( sha1( $oldpassword ) == $this->user->motdepasse )
                {
                    $this->user->motdepasse = sha1( $newpassword );
                    if ( $this->users->Update( $this->user ) )
                    {
                        $this->view[ "success" ] = true;
                    }
                    else $this->view["error"] = "Une erreur ses produite lors du changement de mot de passe.";
                }
                else $this->view["error"] = "Mot de passe actuel incorrect.";
            }
            else $this->view["error"] = "Le nouveau mot de passe et la confirmation ne correspondent pas.";
        }
        else $this->view["error"] = "Un ou plusieurs champs ne sont pas correctement remplis.";

        $this->render("editpassword");
    }

    public function recoveData()
    {
        if ( !$this->user )
            $this->unauthorized();

        header('Content-type: application/json');
        echo json_encode( $this->user );
    }
}

?>