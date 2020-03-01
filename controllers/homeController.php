<?php

require CORE. "/controller.php";

class homeController extends Controller
{
    /**
     * Page d'accueil
     */
    public function index()
    {
        $this->view["title"] = "Accueil";
        $this->render("index");
    }

    public function test()
    {
        if (!Session::Loggin())
            $this->unauthorized();

        $this->view["title"] = "Page utilisateur";
        $this->render("test");
    }
}

?>