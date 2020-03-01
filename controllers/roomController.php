<?php

require CORE. "/controller.php";

class roomController extends Controller
{
    /**
     * Page d'accueil
     */
    public function index()
    {
        $this->render("index");
    }
}

?>