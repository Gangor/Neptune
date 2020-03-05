<?php

require CORE. "/controller.php";
require CORE. "/reservations.php";

require MODELS. "/reservation/searchModel.php";
require MODELS. "/reservation/clearModel.php";

class reservationController extends Controller
{
    public $reservation;

    function __construct()
    {
        $this->reservation = new Reservations();
    }

    /**
     * 
     * GET : /reservation/index
     * Page liste des réservations
     * 
     */
    public function index()
    {
        if ( !$this->user || !$this->user->admin )
            $this->unauthorized();

        $model = new SearchModel();
        
        $this->view[ 'reservations' ] = $this->reservation->GetReservations( $model->Search ?? '' );
        $this->render( 'index', $model );
    }

    /**
     * 
     * GET : /reservation/clear/
     * Suppression toute les réservations
     * 
     * @param   int $id ID de la chambre
     * 
     */
    public function clear()
    {
        if ( !$this->user || !$this->user->admin )
            $this->unauthorized();

        $model = new ClearModel( true );

        $this->view[ 'reservations' ] = $this->reservation->GetReservations( '' );
        $this->render( 'clear', $model );
    }

    /**
     * 
     * POST : /reservation/clearConfirm
     * Confirmation de suppression toute les réservations
     * 
     * @param   int $id ID de l'utilisateur
     * 
     */
    public function clearConfirm()
    {
        if ( !$this->user || !$this->user->admin )
            $this->unauthorized();

        $model = new ClearModel();

        if ( $model->IsValid )
        {
            if ( $this->user->motdepasse == sha1( $model->Password ) )
            {
                if ( $this->reservation->clear() )
                {
                    Router::redirectLocal( 'reservation', 'index' );
                }
                else $this->view["error"] = "Une erreur ses produite lors de la suppresion de de toute les réservations.";
            }
            else $this->view["error"] = "Mot de passe invalide.";
        }
        else $this->view[ 'error' ] = 'Un ou plusieurs champs ne sont pas correctement remplis.';

        $this->render( 'clear', $this->reservation->GetReservations( '' ) );
    }

    /**
     * 
     * GET : /reservation/delete/{id}
     * Suppression d'une réservation
     * 
     * @param   int $id ID de la chambre
     * 
     */
    public function delete( int $id )
    {
        if ( !$this->user || !$this->user->admin )
            $this->unauthorized();

        $reservation = $this->reservation->GetReservation( $id );

        if ( $reservation == null )
            $this->not_found();

        $this->render( 'delete', $reservation );
    }

    /**
     * 
     * POST : /reservation/deleteConfirm/{id}
     * Confirmation de suppression d'une réservation
     * 
     * @param   int $id ID de l'utilisateur
     * 
     */
    public function deleteConfirm( int $id )
    {
        if ( !$this->user || !$this->user->admin )
            $this->unauthorized();

        $reservation = $this->reservation->GetReservation( $id );

        if ( $reservation == null )
            $this->not_found();

        if ( $this->reservation->delete( $id ) )
        {
            Router::redirectLocal( 'reservation', 'index' );
        }
        else $this->view["error"] = "Une erreur ses produite lors de la suppresion de l'utilisateur.";

        $this->render( 'delete', $reservation );
    }
}

?>