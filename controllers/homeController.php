<?php

require CORE. "/controller.php";
require CORE. "/rooms.php";

require MODELS. "/room/reserveModel.php";

class homeController extends Controller
{
    public $rooms;

    function __construct()
    {
        $this->rooms = new Rooms();
    }

    /**
     * 
     * GET : /home/index
     * Page d'accueil
     * 
     */
    public function index()
    {
        $model = new ReserveModel( true );

        $this->view[ 'rooms' ] = $this->rooms->GetPolularRooms();
        $this->render( 'index', $model );
    }


    /**
     * 
     * GET : /home/reserve
     * Reserver une chambre affiche la liste des chambre disponible
     * 
     * @param   int $id ID de la chambre
     * 
     */
    public function reserve()
    {
        if ( !$this->user )
            $this->unauthorized();

        $model = new ReserveModel();
        $rooms = [];

        if ( $model->IsValid )
        {
            $debut = DateTime::createFromFormat('Y-m-d', $model->Debut);
            $fin = DateTime::createFromFormat('Y-m-d', $model->Fin);

            if ( $debut < $fin )
                $rooms = $this->rooms->GetRoomsAvailable( $model->Debut, $model->Fin );
            else $this->view["error"] = "La date de début dois être inférieur à celle de fin.";
        }
        
        $this->view[ 'rooms' ] = $rooms;
        $this->render( 'reserve', $model );
    }
}

?>