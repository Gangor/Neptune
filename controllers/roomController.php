<?php

require CORE. "/controller.php";
require CORE. "/rooms.php";

class roomController extends Controller
{
    private $rooms;

    function __construct()
    {
        $this->rooms = new Rooms();
    }

    /**
     * 
     * GET : /room/index
     * Page d'accueil
     * 
     */
    public function index()
    {
        $this->view[ 'rooms' ] = $this->rooms->GetRooms();
        $this->render( 'index' );
    }

    /**
     * 
     * GET : /room/delete/{id}
     * Suppression d'une chambre
     * 
     * @param   int $id ID de la chambre
     * 
     */
    public function delete( int $id )
    {
        if ( !$this->user || !$this->user->admin )
            $this->unauthorized();

        $room = $this->rooms->GetRoomById( $id );

        if ( $room == null )
            $this->not_found();

        $this->view[ 'room' ] = $room;
        $this->render( 'delete' );
    }

    /**
     * 
     * POST : /room/deleteConfirm/{id}
     * Confirmation de suppression d'une chambre
     * 
     * @param   int $id ID de la chambre
     * 
     */
    public function deleteConfirm( int $id )
    {
        if ( !$this->user || !$this->user->admin )
            $this->unauthorized();

        $room = $this->rooms->GetRoomById( $id );

        if ( $room == null )
            $this->not_found();

        if ( $this->rooms->delete( $id ) )
            Router::redirectLocal( 'room', 'index' );

        $this->view[ 'room' ] = $room;
        $this->render( 'delete' );
    }
}

?>