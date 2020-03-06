<?php

use Konekt\PdfInvoice\InvoicePrinter;

require  PLUGINS. '/fpdf/fpdf.php';
require  PLUGINS. '/PDFInvoice/src/InvoicePrinter.php';

class Invoice
{
    /**
     * Objet pdf invoice
     * @var object $invoice
     */
    public $invoice;

    function __construct()
    {
        $this->invoice = new InvoicePrinter( 'A4', '€', 'fr' );
    }

    /**
     * 
     * Crée une facture PDF avec plusieurs mode de render
     * 
     * @param object $reservation   Objet de réservation
     * @param string $render        Type de rendue
     * @return string contenue du PDF
     * 
     */
    function Create( object $reservation, string $render = 'S' )
    {
        $debut  = DateTime::createFromFormat('Y-m-d H:i:s', (string)$reservation->debut);
        $fin    = DateTime::createFromFormat('Y-m-d H:i:s', (string)$reservation->fin);
        $days   = $fin->diff($debut)->format("%a");

        $title          = 'Chambre N°'. $reservation->numero;
        $description    = $debut->format( 'd/m/y' ). ' au '. $fin->format( 'd/m/y' );
        $quantity       = $days.' jour(s)';

        $this->invoice->setLogo( ROOT. "/favicon.png" );
        $this->invoice->setColor( "#677a1a" );
        $this->invoice->setType( "Facture" );
        $this->invoice->setReference( "#".$reservation->tid );
        $this->invoice->setDate(date( 'd-m-Y', time() ));
        $this->invoice->hide_tofrom();
        
        $this->invoice->addItem( $title, $description, $quantity, false, $reservation->prix, false, $reservation->prix );
        $this->invoice->addBadge( $reservation->paye == -1 ? "Payé" : "À payer" );
        
        $this->invoice->addTotal( "Total", $reservation->prix );
        $this->invoice->addTotal( "Total TTC", $reservation->prix, true );
        
        return $this->invoice->render( '', $render );
    }
}

?>