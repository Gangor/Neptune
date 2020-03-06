<?php 

include_once CORE. "/database.php";

class Rooms
{
    var $conn;

    /**
     * 
     * Initialise une instance de gestionnaire de chambre
     * 
     */
    function __construct()
    {
        $this->conn = Database::GetConnection();
    }

    /**
     * 
     * Crée une photo pour une chambre en base de donnée
     * 
     * @param   object $chambre    Photo à ajouter
     * @return  int
     * 
     */
    function Attach( object $photo )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( "INSERT INTO photos (chambre_id, photo) VALUES (:chambre_id, :photo)" );            
            $statement->bindParam(':chambre_id', $photo->chambre_id );
            $statement->bindParam(':photo', $photo->photo );
            $statement->execute();

            return $this->conn->lastInsertId();
        }
    }

    /**
     * 
     * Crée une chambre en base de donnée
     * 
     * @param   object $chambre    Chambre à ajouter
     * @return  int
     * 
     */
    function Create( object $chambre )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( "INSERT INTO chambres (capacite, exposition, douche, etage, tarif_id) VALUES (:capacite, :exposition, :douche, :etage, :tarif_id)" );            
            $statement->bindParam(':capacite', $chambre->capacite );
            $statement->bindParam(':exposition', $chambre->exposition );
            $statement->bindParam(':douche', $chambre->douche );
            $statement->bindParam(':etage', $chambre->etage );
            $statement->bindParam(':tarif_id', $chambre->tarif_id );
            $statement->execute();

            return $this->conn->lastInsertId();
        }
    }

    /**
     * 
     * Supprime une chambre en base de donnée
     * 
     * @param   int $id    ID de la chambre
     * @return  bool
     * 
     */
    function Delete( int $numero )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'DELETE FROM chambres where numero = :numero' );
            $statement->bindParam(':numero', $numero );
            
            return $statement->execute();
        }
    }

    /**
     * 
     * Supprime une photo en base de donnée
     * 
     * @param   int $id    ID de la chambre
     * @return  bool
     * 
     */
    function Detach( int $numero )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'DELETE FROM photos where num = :numero' );
            $statement->bindParam(':numero', $numero );
            
            return $statement->execute();
        }
    }

    /**
     * 
     * Récupère la liste des chambres et permet la recherche de numéro
     * 
     * @param   string $search  Recherche par numéro
     * @return  object
     * 
     */
    function GetRooms( string $search = '' )
    {
        if ( $this->conn )
        {
            $search = "%$search%";
            $statement = $this->conn->prepare( 'SELECT * FROM chambres LEFT JOIN tarifs on tarif_id = id WHERE numero LIKE :search' );
            $statement->bindParam(':search', $search );

            if ( $statement->execute() )
            {
                $chambres = $statement->fetchAll( PDO::FETCH_OBJ );
                $statement->closeCursor();
                return $chambres;
            }
        }
    }

    /**
     * 
     * Récupère la liste des chambres populaire
     * 
     * @param int $limit    Nombre de chambre
     * @return  object[]
     * 
     */
    function GetPolularRooms( int $limit = 6 )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'SELECT * FROM planning INNER JOIN chambres ON chambre_id = numero LEFT JOIN tarifs t ON tarif_id = t.id GROUP BY chambre_id ORDER BY count(*) DESC limit :limit' );
            $statement->bindParam(':limit', $limit, PDO::PARAM_INT );

            if ( $statement->execute() )
            {
                $tarifs = $statement->fetchAll( PDO::FETCH_OBJ );
                $statement->closeCursor();

                return $tarifs;
            }
        }
    }

    /**
     * 
     * Récupère la liste des photos d'une chambre
     * 
     * @param int $id    ID de la chambre
     * @return  object[]
     * 
     */
    function GetPhotos( int $id )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'SELECT * FROM photos WHERE chambre_id = :id' );
            $statement->bindParam(':id', $id );

            if ( $statement->execute() )
            {
                $photos = $statement->fetchAll( PDO::FETCH_OBJ );
                $statement->closeCursor();

                return $photos;
            }
        }
    }

    /**
     * 
     * Récupère une photos d'une chambre
     * 
     * @param int $id    ID de la chambre
     * @return  object
     * 
     */
    function GetPhoto( int $id )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'SELECT * FROM photos WHERE num = :id' );
            $statement->bindParam(':id', $id );

            if ( $statement->execute() )
            {
                $photo = $statement->fetch( PDO::FETCH_OBJ );
                $statement->closeCursor();

                return $photo;
            }
        }
    }

    /**
     * 
     * Récupère une chambre à partir sont ID en base de donnée
     * 
     * @param   int $id    Numero de la chambre
     * @return  object
     * 
     */
    function GetRoomById( int $numero )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'SELECT * FROM chambres LEFT JOIN tarifs on tarif_id = id where numero = :numero' );
            $statement->bindParam(':numero', $numero );

            if ( $statement->execute() )
            {
                $user = $statement->fetch( PDO::FETCH_OBJ );
                $statement->closeCursor();

                return $user;
            }
        }
    }

    /**
     * 
     * Récupère la liste des chambres disponible dans la période précisé en base de donnée
     * 
     * @param   int $debut Date de début
     * @param   int $fin   Date de fin
     * @return  object
     * 
     */
    function GetRoomsAvailable( string $debut, string $fin )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'SELECT * FROM chambres LEFT JOIN tarifs on tarif_id = id WHERE numero not in (SELECT chambre_id FROM planning where reservation = -1 and ((debut between :debut and :fin) OR (fin between :debut and :fin)))' );
            $statement->bindParam(':debut', $debut );
            $statement->bindParam(':fin', $fin );

            if ( $statement->execute() )
            {
                $user = $statement->fetchAll( PDO::FETCH_OBJ );
                $statement->closeCursor();

                return $user;
            }
        }
    }

    /**
     * 
     * Mes à jour de la chambre en base de donnée
     * 
     * @param   object $chambre    Chambre à mettre à jour
     * @return  bool
     * 
     */
    function Update( object $chambre )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( "UPDATE chambres SET capacite = :capacite, exposition = :exposition, douche = :douche, etage = :etage, tarif_id = :tarif_id WHERE numero = :numero" );
            $statement->bindParam(':numero', $chambre->numero );
            $statement->bindParam(':capacite', $chambre->capacite );
            $statement->bindParam(':exposition', $chambre->exposition );
            $statement->bindParam(':douche', $chambre->douche );
            $statement->bindParam(':etage', $chambre->etage );
            $statement->bindParam(':tarif_id', $chambre->tarif_id );

            
            return $statement->execute();
        }
    }
}

?>