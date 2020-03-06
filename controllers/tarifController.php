<?php

require CORE. "/controller.php";
require CORE. "/tarifs.php";

require MODELS. "/tarif/createModel.php";

class tarifController extends Controller
{
    public $tarifs;

    function __construct()
    {
        $this->tarifs = new Tarifs();
    }

    /**
     * 
     * GET : /tarif/index
     * Page des chambres avec filtre et tri
     * 
     */
    public function index()
    {
        $this->render( 'index', (object)$this->tarifs->GetTarifs( PDO::FETCH_OBJ ) );
    }

    /**
     * 
     * GET : /tarif/create
     * Page de création de tarif
     * 
     */
    public function create()
    {
        if ( !$this->user || !$this->user->admin )
            $this->unauthorized();
        
        $model = new createModel( true );

        $this->render( 'create', $model );
    }

    /**
     * 
     * GET : /tarif/createConfirm
     * Page de création de tarif
     * 
     */
    public function createConfirm()
    {
        if ( !$this->user || !$this->user->admin )
            $this->unauthorized();
        
        $model = new createModel();

        if ( $model->IsValid )
        {
            $tarif = new stdClass();
            $tarif->prix = $model->Prix;

            $this->tarifs->create( $tarif );
            Router::redirectLocal( 'tarif', 'index' );
        }
        else $this->view["error"] = "Un ou plusieurs champs ne sont pas correctement remplis.";

        $this->render( 'create', $model );
    }
}

?>