<?php

require CORE. "/controller.php";

class testController extends Controller
{
    /**
     * Page pour faire des tests
     */
    public function index( int $id, string $message )
    {
        $this->view["title"] = "Chambre";
        $this->view["id"] = $id;
        $this->view["message"] = $message;

        //Router::redirectLocal( "home", "index" );

        $this->render("index");
    }
}

?>