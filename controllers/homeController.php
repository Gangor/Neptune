<?php

require CORE. "/controller.php";

class homeController extends Controller
{
    /**
     * 
     * GET : /home/index
     * Page d'accueil
     * 
     */
    public function index()
    {
        $this->view["title"] = "Accueil";
        $this->render("index");
    }
}

?>