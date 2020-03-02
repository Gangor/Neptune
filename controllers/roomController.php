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
     * Page d'accueil
     */
    public function index()
    {
        $this->view[ 'rooms' ] = $this->rooms->GetRooms();
        $this->render("index");
    }
}

?>