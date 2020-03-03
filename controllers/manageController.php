<?php

require CORE. "/controller.php";

require MODELS. "/manage/editModel.php";
require MODELS. "/manage/editPasswordModel.php";

class manageController extends Controller
{
    private $users;

    public function __construct()
    {
        $this->users = new Users();
    }

    /*
     *
     * GET : /manage/index
     * Page des paramètres utilisateur
     * 
     */
    public function index()
    {
        if ( !$this->user )
            $this->unauthorized();
        
        $model = new EditModel( true );
        $model->Parse( $this->user );

        $this->view[ 'pays' ] = $this->users->GetPays();
        $this->render( 'index', $model );
    }

    /*
     *
     * POST : /manage/editconfirm
     * Page de confirmation des paramètres utilisateur
     * 
     */
    public function editconfirm()
    {
        if ( !$this->user )
            $this->unauthorized();

        $model = new EditModel();

        if ( $model->IsValid )
        {
            $this->user->civilite   = $model->Civilite;
            $this->user->prenom     = $model->Prenom;
            $this->user->nom        = $model->Nom;

            if ( !$this->user->admin )
            {
                $this->user->pays_id    = (int)$model->Pays;
                $this->user->adresse    = $model->Adresse;
                $this->user->ville      = $model->Ville;
                $this->user->codePostal = $model->CodePostal;
            }

            if ( $this->users->Update( $this->user ) )
            {
                $this->view[ 'success' ] = true;
            }
            else $this->view[ 'error' ] = 'Une erreur ses produite lors de l\'édition du compte.';
        }
        else $this->view[ 'error' ] = 'Un ou plusieurs champs ne sont pas correctement remplis.';

        $this->view[ 'pays' ] = $this->users->GetPays();
        $this->render( 'index', $model );
    }

    /*
     *
     * GET : /manage/editpassword
     * Page de changement de mot de passe
     * 
     */
    public function editpassword()
    {            
        if ( !$this->user )
            $this->unauthorized();

        $model = new editPasswordModel( true );
        $this->render( 'editpassword', $model );
    }

    /*
     *
     * POST : /manage/editpasswordConfirm
     * Page de confirmation de changement de mot de passe
     */ 
    public function editpasswordConfirm()
    {            
        if ( !$this->user )
            $this->unauthorized();

        $model = new editPasswordModel();

        if ( $model->IsValid )
        {
            if ( $model->NewPassword == $model->Confirm )
            {
                if ( $this->user->motdepasse == sha1( $model->OldPassword ) )
                {
                    $this->user->motdepasse = sha1( $model->NewPassword );

                    if ( $this->users->Update( $this->user ) )
                    {
                        $this->view[ 'success' ] = true;
                    }
                    else $this->view[ 'error' ] = 'Une erreur ses produite lors du changement de mot de passe.';
                }
                else $this->view[ 'error' ] = 'Mot de passe actuel incorrect.';
            }
            else $this->view[ 'error' ] = 'Le nouveau mot de passe et la confirmation ne correspondent pas.';
        }
        else $this->view[ 'error' ] = 'Un ou plusieurs champs ne sont pas correctement remplis.';

        $this->render( 'editpassword', $model );
    }

    /*
     *
     * GET : /manage/editpassword
     * Page de récupération des données utilisateur
     */
    public function recoveData()
    {
        if ( !$this->user )
            $this->unauthorized();

        header('Content-type: application/json');
        echo json_encode( $this->user );
    }
}

?>