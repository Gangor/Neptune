<?php 

include_once CORE. "/database.php";

class Rooms
{
    var $conn;

    function __construct()
    {
        $this->conn = Database::GetConnection();
    }

    function Create( object $chambre )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( "INSERT INTO chambres (numero, capacite, exposition, douche, etage, tarif_id) VALUES (:numero, :capacite, :exposition, :douche, :etage, :tarif_id)" );            
            $statement->bindParam(':numero', $chambre->numero );
            $statement->bindParam(':capacite', $chambre->capacite );
            $statement->bindParam(':exposition', $chambre->exposition );
            $statement->bindParam(':douche', $chambre->douche );
            $statement->bindParam(':etage', $chambre->etage );
            $statement->bindParam(':tarif_id', $chambre->tarif_id );
            $statement->execute();

            return $this->conn->lastInsertId();
        }
    }

    function Delete( int $numero )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'DELETE FROM clients where numero = :numero' );
            $statement->bindParam(':numero', $numero );

            return $statement->execute();
        }
    }

    function GetTarifs()
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'SELECT * FROM tarifs' );

            if ( $statement->execute() )
            {
                $tarifs = $statement->fetchAll( PDO::FETCH_OBJ );
                $statement->closeCursor();

                return $tarifs;
            }
        }
    }

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

    function Update( object $chambre )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( "UPDATE chambres SET capacite = :capacite, exposition = :exposition, douche = :douche, etage = :etage, tarif_id = :tarif_id WHERE numero = :numero" );
            $statement->bindParam(':capacite', $chambre->capacite );
            $statement->bindParam(':exposition', $chambre->exposition );
            $statement->bindParam(':douche', $chambre->douche );
            $statement->bindParam(':etage', $chambre->etage );
            $statement->bindParam(':tarif_id', $chambre->tarif_id );
            $statement->bindParam(':numero', $chambre->numero );
            
            return $statement->execute();
        }
    }
}

?>