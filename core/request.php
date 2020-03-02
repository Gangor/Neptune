<?php

class Request
{
    /**
     * Lien URI de la requête
     * $_SERVER[ 'REQUEST_URI' ]
     * @var string $url
     */
    public $url;
    
    /**
     * Controller de la requête
     * @var string $controller
     */
    public $controller;

    /**
     * Action de la requête
     * @var string $action
     */
    public $action;

    /**
     * Paramètre de la requête
     * @var array $params
     */
    public $params = array();

    /**
     * Initialise une instance requête
     */
    public function __construct()
    {
        $this->url = $_SERVER[ 'REQUEST_URI' ];
    }
}

?>