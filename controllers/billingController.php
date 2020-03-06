<?php

require CORE. "/controller.php";
require CORE. "/email.php";
require CORE. "/invoice.php";
require CORE. "/reservations.php";

require MODELS. "/billing/buyModel.php";

class billingController extends Controller
{
    private $email;
    private $invoice;
    public $reservations;

    function __construct()
    {
        $this->email = new Email();
        $this->invoice = new Invoice();
        $this->reservations = new Reservations();
    }

    /**
     * 
     * GET : /billing/buy/{id}
     * Page de paiement
     * 
     * @param int $id   ID de réservation
     * 
     */
    public function buy( int $id )
    {
        if ( !$this->user )
            $this->unauthorized();
        
        $reservation = $this->reservations->GetReservation( $id );

        if ( $reservation == null )
            $this->not_found();

        if ( $reservation->client_id != $this->user->id )
            $this->not_found();

        if ( $reservation->paye == -1 )
            $this->not_found();

        $model = new BuyModel( true );

        $this->view[ 'reservation' ] = $reservation;
        $this->render( 'buy', $model );
    }

    /**
     * 
     * GET : /billing/buyConfirm/{id}
     * Page de confirmation de paiement
     * 
     * @param int $id   ID de réservation
     * 
     */
    public function buyConfirm( int $id )
    {
        if ( !$this->user )
            $this->unauthorized();
        
        $reservation = $this->reservations->GetReservation( $id );

        if ( $reservation == null )
            $this->not_found();

        if ( $reservation->client_id != $this->user->id )
            $this->not_found();

        if ( $reservation->paye == -1 )
            $this->not_found();

        $model = new BuyModel();

        if ( $model->IsValid )
        {
            $reservation->paye = -1;

            if ( $this->reservations->Update( $reservation ) )
            {
                $invoice = new stdClass();

                $invoice->content = $this->invoice->Create( $reservation );
                $invoice->filename = 'facture.pdf';

                $this->email->Send( $this->user, 'Réservation', 'reservation', $invoice );
                Router::redirectLocal( 'manage', 'reservations' );
            }
            else $this->view["error"] = "Une erreur ses produite lors du paiement de votre réservation.";
        }

        $this->view[ 'reservation' ] = $reservation;
        $this->render( 'buy', $model );
    }
}

?>