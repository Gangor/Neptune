<?php

require CORE. "/controller.php";
require CORE. "/rooms.php";

class homeController extends Controller
{
    private $rooms;

    function __construct()
    {
        $this->rooms = new Rooms();
    }

    /**
     * 
     * GET : /home/index
     * Page d'accueil
     * 
     */
    public function index()
    {
        $this->render( 'index', $this->rooms->GetPolularRooms() );
    }
}

?>