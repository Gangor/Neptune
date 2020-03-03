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
     * Récupère un tarif par sont id en base de donnée
     * 
     * @return object
     * 
     */
    function GetTarif( int $id )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'SELECT * FROM tarifs WHERE id = :id' );
            $statement->bindParam(':id', $id );

            if ( $statement->execute() )
            {
                $tarif = $statement->fetch( PDO::FETCH_OBJ );
                $statement->closeCursor();

                return $tarif;
            }
        }
    }

    /**
     * 
     * Récupère la liste des tarifs en base de donnée
     * 
     * @return object[]
     * 
     */
    function GetTarifs()
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'SELECT * FROM tarifs' );

            if ( $statement->execute() )
            {
                $tarifs = $statement->fetchAll();
                $statement->closeCursor();

                return $tarifs;
            }
        }
    }

    /**
     * 
     * Récupère la liste des chambres et permet un trie personnalisé
     * 
     * @param   string $column  Colonne à filtrer
     * @param   string $filter  Valeur de la colonne
     * @return  object
     * 
     */
    function GetRooms( string $column = 'numero', string $filter = '%%' )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'SELECT * FROM chambres LEFT JOIN tarifs on tarif_id = id WHERE :column LIKE :filter' );
            $statement->bindParam(':column', $column );
            $statement->bindParam(':filter', $filter );

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
            $statement = $this->conn->prepare( 'SELECT * FROM planning INNER JOIN chambres ON chambre_id = numero LEFT JOIN tarifs ON tarif_id = id GROUP BY chambre_id ORDER BY count(*) DESC limit :limit' );
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
            $statement = $this->conn->prepare( 'SELECT * FROM chambres where numero = :numero' );
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