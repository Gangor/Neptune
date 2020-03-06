<?php

require CORE. "/controller.php";
require CORE. "/rooms.php";
require CORE. "/reservations.php";
require CORE. "/tarifs.php";

require MODELS. "/room/createModel.php";
require MODELS. "/room/editModel.php";
require MODELS. "/shared/searchModel.php";
require MODELS. "/room/reserveModel.php";
require MODELS. "/room/reserveConfirmModel.php";
require MODELS. "/room/uploadModel.php";

class roomController extends Controller
{
    public $rooms;
    public $reservations;
    public $tarifs;

    function __construct()
    {
        $this->rooms = new Rooms();
        $this->reservations = new Reservations();
        $this->tarifs = new Tarifs();
    }

    /**
     * 
     * GET : /room/index
     * Page des chambres avec filtre et tri
     * 
     */
    public function index()
    {
        $model = new SearchModel();

        $this->view[ 'rooms' ] = $this->rooms->GetRooms( $model->Search ?? '' );
        $this->render( 'index', $model );
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
        $this->view[ 'tarifs' ] = $this->tarifs->GetTarifs();

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
            $tarif = $this->tarifs->GetTarif( $model->Tarif );

            if ( $tarif )
            {
                $room = new stdClass();

                $room->capacite     = (int)$model->Capacite;
                $room->exposition   = $model->Exposition;
                $room->douche       = (int)$model->Douche;
                $room->etage        = (int)$model->Etage;
                $room->tarif_id     = (int)$model->Tarif;

                if ( $this->rooms->Create( $room ) )
                {
                    Router::redirectLocal( 'room', 'index' );
                }
                else $this->view["error"] = "Une erreur ses produite lors de l'ajout d'une chambre.";
            }
            else $this->view["error"] = "Le champs tarif est invalide.";
        }
        else $this->view["error"] = "Un ou plusieurs champs ne sont pas correctement remplis.";

        $this->view[ 'tarifs' ] = $this->tarifs->GetTarifs();
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
        $this->view[ 'photos' ] = $this->rooms->GetPhotos( $id );
        $this->view[ 'tarifs' ] = $this->tarifs->GetTarifs();
        $this->view[ 'upload' ] = new UploadModel( true );
        
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
            $tarif = $this->tarifs->GetTarif( $model->Tarif );

            if ( $tarif )
            {
                $room->capacite     = (int)$model->Capacite;
                $room->exposition   = $model->Exposition;
                $room->douche       = (int)$model->Douche;
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
        $this->view[ 'photos' ] = $this->rooms->GetPhotos( $id );
        $this->view[ 'tarifs' ] = $this->tarifs->GetTarifs();
        $this->view[ 'upload' ] = new UploadModel( true );

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

        $this->render( 'delete', $room );
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

        $this->render( 'delete', $room );
    }

    /**
     * 
     * POST : /room/deletePhoto/{id}
     * Supprime une photo d'une chambre
     * 
     * @param   int $id ID de la photo
     * 
     */
    public function deletePhoto( int $id )
    {
        if ( !$this->user || !$this->user->admin )
            $this->unauthorized();

        $photo = $this->rooms->GetPhoto( $id );

        if ( $photo == null )
            $this->not_found();

        if ( $this->rooms->Detach( $id ) )
        {
            Router::redirectLocalWithParams( 'room', 'edit', array( 'id' => $photo->chambre_id ) );
        }
        else $this->view["error"] = "Une erreur ses produite lors de la suppresion de la chambre.";
    }

    /**
     * 
     * GET : /room/reserve/{id}
     * Réserve d'une chambre
     * 
     * @param   int $id ID de la chambre
     * 
     */
    public function reserve( int $id )
    {
        if ( !$this->user )
            $this->unauthorized();

        $room = $this->rooms->GetRoomById( $id );

        if ( $room == null )
            $this->not_found();
        
        $model = new ReserveModel( true );
        
        $this->view[ 'room' ]   = $room;
        $this->render( 'reserve', $model );
    }


    /**
     * 
     * GET : /room/reserve/{id}
     * Confirmation de réservation d'une chambre
     * 
     * @param   int $id ID de la chambre
     * 
     */
    public function reserveConfirm( int $id )
    {
        if ( !$this->user )
            $this->unauthorized();

        $room = $this->rooms->GetRoomById( $id );

        if ( $room == null )
            $this->not_found();
        
        $model = new ReserveModel();

        if ( $model->IsValid )
        {
            $debut = DateTime::createFromFormat('Y-m-d', $model->Debut);
            $fin = DateTime::createFromFormat('Y-m-d', $model->Fin);
            $days = $fin->diff($debut)->format("%a");

            if ( $debut < $fin )
            {
                if ( !$this->reservations->GetPlannings( $id, $model->Debut, $model->Fin ) )
                {
                    $model = new ReserveConfirmModel( true );
                    
                    $this->view[ 'price' ] = $days;
                    $this->view[ 'room' ] = $room;
                    $this->render( 'reserveConfirm', $model );
                    return;
                }
                else $this->view["error"] = "Cette période ne peut pas être réservé car elle contient une autre réservation.";
            }
            else $this->view["error"] = "La date de début dois être inférieur à celle de fin.";
        }
        
        $this->view[ 'room' ] = $room;
        $this->render( 'reserve', $model );
    }


    /**
     * 
     * GET : /room/reserveFinish/{id}
     * Finalisation de la réservation d'une chambre
     * 
     * @param   int $id ID de la chambre
     * 
     */
    public function reserveFinish( int $id )
    {
        if ( !$this->user )
            $this->unauthorized();

        $room = $this->rooms->GetRoomById( $id );

        if ( $room == null )
            $this->not_found();
        
        $model = new ReserveConfirmModel( true );

        if ( $model->IsValid )
        {
            $debut = DateTime::createFromFormat('Y-m-d', $model->Debut);
            $fin = DateTime::createFromFormat('Y-m-d', $model->Fin);
            $days = $fin->diff($debut)->format("%a");

            if ( $debut < $fin )
            {
                if ( !$this->reservations->GetPlannings( $id, $model->Debut, $model->Fin ) )
                {
                    $reservation = new stdClass();
    
                    $reservation->chambre_id = $id;
                    $reservation->debut = $debut->format('Y-m-d');
                    $reservation->fin = $fin->format('Y-m-d');
                    $reservation->reservation = -1;
                    $reservation->paye = 0;
                    $reservation->prix = $room->prix * $days;
                    $reservation->client_id = $this->user->id;
                    
                    $result = $this->reservations->Create( $reservation );
                    
                    if ( $result )
                    {                        
                        Router::redirectLocalWithParams( 'room', 'reserveSuccess', array( 'id' => $result ) );
                    }
                    else $this->view["error"] = "Une erreur ses produite lors de la réservation de la chambre.";
                }
                else $this->view["error"] = "Cette période ne peut pas être réservé car elle contient une autre réservation.";
            }
            else $this->view["error"] = "La date de début dois être inférieur à celle de fin.";
        }
        
        $this->view[ 'room' ] = $room;
        $this->render( 'reserveConfirm', $model );
    }

    public function reserveSuccess( int $id )
    {
        if ( !$this->user )
            $this->unauthorized();

        $reservation = $this->reservations->GetReservation( $id );

        if ( $reservation == null )
            $this->not_found();

        if ( $this->user->id != $reservation->client_id )
            $this->not_found();
        
        $this->render( 'reserveSuccess', $reservation );
    }

    /**
     * 
     * POST : /room/upload/{id}
     * Upload d'une image pour une chambre
     * 
     * @param   int $id ID de la chambre
     * 
     */
    public function upload( int $id )
    {
        if ( !$this->user || !$this->user->admin )
            $this->unauthorized();

        $room = $this->rooms->GetRoomById( $id );

        if ( $room == null )
            $this->not_found();

        $model = new EditModel( true );
        $model->Parse( $room );

        $upload = new UploadModel();

        if ( $upload->IsValid )
        {
            $dir = ROOT. '/assets/images/';
            $name =  uniqid().'.jpg';
            
            if ( move_uploaded_file( $upload->Photo['tmp_name'], $dir.$name ) ) 
            {
                $photo = new stdClass();

                $photo->chambre_id = $id;
                $photo->photo = (string)$name;

                if ( $this->rooms->Attach( $photo ) )
                {
                    Router::redirectLocalWithParams( 'room', 'edit', array( 'id' => $id ) );
                }
                else $this->view["error2"] = "Une erreur ses produite lors de l'ajout de l'image en base de donnée.";
            } 
            else $this->view["error2"] = "Une erreur ses produite lors du téléchargement de l'image.";
        }

        $this->view[ 'room' ]   = $room;
        $this->view[ 'photos' ] = $this->rooms->GetPhotos( $id );
        $this->view[ 'tarifs' ] = $this->tarifs->GetTarifs();
        $this->view[ 'upload' ] = $upload;
        
        $this->render( 'edit', $model );
    }
}

?>