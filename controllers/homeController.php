<?php

require ROOT. "/core/controller.php";

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
        $this->invalid();
    }
}

?>