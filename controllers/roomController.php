<?php

require CORE. "/controller.php";
require CORE. "/rooms.php";

require MODELS. "/room/createModel.php";
require MODELS. "/room/editModel.php";

class roomController extends Controller
{
    private $rooms;

    function __construct()
    {
        $this->rooms = new Rooms();
    }

    /**
     * 
     * GET : /room/index
     * Page d'accueil
     * 
     */
    public function index()
    {
        $this->render( 'index', $this->rooms->GetRooms() );
    }

    /**
     * 
     * GET : /room/create
     * Page de création de chambre
     * 
     */
    public function create()
    {
        if ( !$this->user || !$this->user->admin )
            $this->unauthorized();
        
        $model = new createModel( true );
        $this->view[ 'tarifs' ] = $this->rooms->GetTarifs();

        $this->render( 'create', $model );
    }

    /**
     * 
     * GET : /room/createConfirm
     * Page de confirmation création de chambre
     * 
     */
    public function createConfirm()
    {
        if ( !$this->user || !$this->user->admin )
            $this->unauthorized();
        
        $model = new createModel();

        if ( $model->IsValid )
        {
            $tarif = $this->rooms->GetTarif( $model->Tarif );

            if ( $tarif )
            {
                $room = new stdClass();

                $room->capacite     = (int)$model->Capacite;
                $room->exposition   = $model->Exposition;
                $room->douche       = (int)$model->Douche;
                $room->etage        = (int)$model->Etage;
                $room->tarif_id     = (int)$model->Tarif;
                
                var_dump( $room );

                if ( $this->rooms->Create( $room ) )
                {
                    Router::redirectLocal( 'room', 'index' );
                }
                else $this->view["error"] = "Une erreur ses produite lors de l'ajout d'une chambre.";
            }
            else $this->view["error"] = "Le champs tarif est invalide.";
        }
        else $this->view["error"] = "Un ou plusieurs champs ne sont pas correctement remplis.";

        $this->view[ 'tarifs' ] = $this->rooms->GetTarifs();
        $this->render( 'create', $model );
    }

    /**
     * 
     * GET : /room/edit/{id}
     * Edition d'une chambre
     * 
     * @param   int $id ID de la chambre
     * 
     */
    public function edit( int $id )
    {
        if ( !$this->user || !$this->user->admin )
            $this->unauthorized();

        $room = $this->rooms->GetRoomById( $id );

        if ( $room == null )
            $this->not_found();

        $model = new EditModel( true );
        $model->Parse( $room );

        $this->view[ 'room' ]   = $room;
        $this->view[ 'tarifs' ] = $this->rooms->GetTarifs();
        
        $this->render( 'edit', $model );
    }

    /**
     * 
     * GET : /room/editconfirm/{id}
     * Edition d'une chambre
     * 
     * @param   int $id ID de la chambre
     * 
     */
    public function editconfirm( int $id )
    {
        if ( !$this->user || !$this->user->admin )
            $this->unauthorized();

        $room = $this->rooms->GetRoomById( $id );

        if ( $room == null )
            $this->not_found();

        $model = new EditModel( false );

        if ( $model->IsValid )
        {
            $tarif = $this->rooms->GetTarif( $model->Tarif );

            if ( $tarif )
            {
                $room->capacite     = (int)$model->Capacite;
                $room->exposition   = $model->Exposition;
                $room->douche       = (bool)$model->Douche;
                $room->etage        = (int)$model->Etage;
                $room->tarif_id     = (int)$model->Tarif;

                if ( $this->rooms->Update( $room ) )
                {
                    $this->view[ "success" ] = true;
                }
                else $this->view["error"] = "Une erreur ses produite lors de l'édition de la chambre.";
            }
            else $this->view["error"] = "Le champs tarif est invalide.";
        }
        else $this->view["error"] = "Un ou plusieurs champs ne sont pas correctement remplis.";

        $this->view[ 'room' ]   = $room;
        $this->view[ 'tarifs' ] = $this->rooms->GetTarifs();

        $this->render( 'edit', $model );
    }

    /**
     * 
     * GET : /room/delete/{id}
     * Suppression d'une chambre
     * 
     * @param   int $id ID de la chambre
     * 
     */
    public function delete( int $id )
    {
        if ( !$this->user || !$this->user->admin )
            $this->unauthorized();

        $room = $this->rooms->GetRoomById( $id );

        if ( $room == null )
            $this->not_found();

        $this->view[ 'room' ] = $room;
        $this->render( 'delete' );
    }

    /**
     * 
     * POST : /room/deleteConfirm/{id}
     * Confirmation de suppression d'une chambre
     * 
     * @param   int $id ID de la chambre
     * 
     */
    public function deleteConfirm( int $id )
    {
        if ( !$this->user || !$this->user->admin )
            $this->unauthorized();

        $room = $this->rooms->GetRoomById( $id );

        if ( $room == null )
            $this->not_found();

        if ( $this->rooms->delete( $room->numero ) )
        {
            Router::redirectLocal( 'room', 'index' );
        }
        else $this->view["error"] = "Une erreur ses produite lors de la suppresion de la chambre.";

        $this->view[ 'room' ] = $room;
        $this->render( 'delete' );
    }
}

?>