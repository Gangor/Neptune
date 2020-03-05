<?php

require CORE. "/controller.php";
require CORE. "/reservations.php";

require MODELS. "/manage/editModel.php";
require MODELS. "/manage/editPasswordModel.php";
require MODELS. "/reservation/searchModel.php";

class manageController extends Controller
{
    private $users;
    private $reservation;

    public function __construct()
    {
        $this->users = new Users();
        $this->reservation = new Reservations();
    }

    /**
     * 
     * GET : /clients/delete
     * Suppression du compte
     * 
     * @param   int $id ID de la chambre
     * 
     */
    public function delete()
    {
        if ( !$this->user )
            $this->unauthorized();

        $this->render( 'delete', $this->user );
    }

    /**
     * 
     * POST : /clients/deleteConfirm
     * Confirmation de suppression du compte
     * 
     * @param   int $id ID de l'utilisateur
     * 
     */
    public function deleteConfirm()
    {
        if ( !$this->user )
            $this->unauthorized();

        if ( $this->users->delete( $this->user->id ) )
        {
            Session::destroy();
            Router::redirectLocal( 'home', 'index' );
        }
        else $this->view["error"] = "Une erreur ses produite lors de la suppresion de l'utilisateur.";

        $this->render( 'delete', $this->user );
    }

    /*
     *
     * GET : /manage/edit
     * Page des paramètres utilisateur
     * 
     */
    public function edit()
    {
        if ( !$this->user )
            $this->unauthorized();
        
        $model = new EditModel( true );
        $model->Parse( $this->user );

        $this->view[ 'pays' ] = $this->users->GetPays();
        $this->render( 'edit', $model );
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
        $this->render( 'edit', $model );
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

    /*
     *
     * GET : /manage/reservations
     * Page de reservations de l'utilisateur
     */
    public function reservations()
    {
        if ( !$this->user )
            $this->unauthorized();

        $model = new SearchModel();
        
        $this->view[ 'reservations' ] = $this->reservation->GetReservationsByUser( $this->user->id, $model->Search ?? '' );
        $this->render( 'reservations', $model );
    }

    /**
     * 
     * GET : /reservation/deleteReservation/{id}
     * Suppression d'une réservation
     * 
     * @param   int $id ID de la chambre
     * 
     */
    public function deleteReservation( int $id )
    {
        if ( !$this->user )
            $this->unauthorized();

        $reservation = $this->reservation->GetReservation( $id );

        if ( $reservation == null )
            $this->not_found();

        if ( $reservation->client_id != $this->user->id )
            $this->not_found();

        $this->render( 'deleteReservation', $reservation );
    }

    /**
     * 
     * POST : /reservation/deleteReservationConfirm/{id}
     * Confirmation de suppression d'une réservation
     * 
     * @param   int $id ID de l'utilisateur
     * 
     */
    public function deleteReservationConfirm( int $id )
    {
        if ( !$this->user )
            $this->unauthorized();

        $reservation = $this->reservation->GetReservation( $id );

        if ( $reservation == null )
            $this->not_found();

        if ( $reservation->client_id != $this->user->id )
            $this->not_found();

        if ( $this->reservation->delete( $id ) )
        {
            Router::redirectLocal( 'manage', 'reservations' );
        }
        else $this->view["error"] = "Une erreur ses produite lors de la suppresion de l'utilisateur.";

        $this->render( 'deleteReservation', $reservation );
    }
}

?>