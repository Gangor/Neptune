<?php

require ROOT. "/core/controller.php";

class userController extends Controller
{
    public function login()
    {
        $this->render("login");
    }

    public function register()
    {
        $this->render("register");
    }
}

?>