<?php

require CORE. "/controller.php";
require CORE. "/invoice.php";
require CORE. "/reservations.php";

require MODELS. "/reservation/searchModel.php";
require MODELS. "/reservation/clearModel.php";

class reservationController extends Controller
{
    public $invoice;
    public $reservations;

    function __construct()
    {
        $this->invoice = new Invoice();
        $this->reservations = new Reservations();
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
        
        $this->view[ 'reservations' ] = $this->reservations->GetReservations( $model->Search ?? '' );
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

        $this->view[ 'reservations' ] = $this->reservations->GetReservations( '' );
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
                if ( $this->reservations->clear() )
                {
                    Router::redirectLocal( 'reservation', 'index' );
                }
                else $this->view["error"] = "Une erreur ses produite lors de la suppresion de de toute les réservations.";
            }
            else $this->view["error"] = "Mot de passe invalide.";
        }
        else $this->view[ 'error' ] = 'Un ou plusieurs champs ne sont pas correctement remplis.';

        $this->render( 'clear', $this->reservations->GetReservations( '' ) );
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

        $reservation = $this->reservations->GetReservation( $id );

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

        $reservation = $this->reservations->GetReservation( $id );

        if ( $reservation == null )
            $this->not_found();

        if ( $this->reservations->delete( $id ) )
        {
            Router::redirectLocal( 'reservation', 'index' );
        }
        else $this->view["error"] = "Une erreur ses produite lors de la suppresion de l'utilisateur.";

        $this->render( 'delete', $reservation );
    }

    /*
     *
     * GET : /manage/invoice/{id}
     * Visualisation de facture
     * 
     * @param int $id ID de réservation
     */
    public function invoice( int $id )
    {
        if ( !$this->user || !$this->user->admin )
            $this->unauthorized();

        $reservation = $this->reservations->GetReservation( $id );

        if ( $reservation == null )
            $this->not_found();

        header( 'Content-Disposition: attachment; filename=facture'. $reservation->tid .'.pdf' );
        header( 'Content-Type: application/pdf' );
        
        echo $this->invoice->Create( $reservation );
    }
}

?>