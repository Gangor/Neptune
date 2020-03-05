<?php 

include_once CORE. "/database.php";

class Reservations
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
     * Crée une reservation en base de donnée
     * 
     * @param   object $chambre    Chambre à ajouter
     * @return  int
     * 
     */
    function Create( object $reservation )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( "INSERT INTO planning (chambre_id, debut, fin, reservation, paye, client_id) VALUES (:chambre_id, :debut, :fin, :reservation, :paye, :client_id)" );            
            $statement->bindParam(':chambre_id', $reservation->chambre_id );
            $statement->bindParam(':debut', $reservation->debut );
            $statement->bindParam(':fin', $reservation->fin );
            $statement->bindParam(':reservation', $reservation->reservation );
            $statement->bindParam(':paye', $reservation->paye );
            $statement->bindParam(':client_id', $reservation->client_id );
            $statement->execute();

            return $this->conn->lastInsertId();
        }
    }

    /**
     * 
     * Supprime une reservation en base de donnée
     * 
     * @param   int $id    ID de la chambre
     * @return  bool
     * 
     */
    function Delete( int $numero )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'DELETE FROM planning where tid = :numero' );
            $statement->bindParam(':numero', $numero );
            
            return $statement->execute();
        }
    }

    /**
     * 
     * Supprime tous les reservations en base de donnée
     * 
     * @return  bool
     * 
     */
    function Clear( )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'DELETE FROM planning' );
            
            return $statement->execute();
        }
    }

    /**
     * 
     * Récupère la liste des réservations d'un chambre en base de donnée
     * 
     * @param   int $id    Numero de la chambre
     * @param   int $debut Date de début
     * @param   int $fin   Date de fin
     * @return  object
     * 
     */
    function GetPlannings( int $id, string $debut, string $fin )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'SELECT * FROM planning where chambre_id = :chambre_id and reservation = -1 and (debut between :debut and :fin) OR (fin between :debut and :fin)' );
            $statement->bindParam(':chambre_id', $id );
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
     * Récupère une réservation par sont id en base de donnée
     * 
     * @param   string $date    Filtre par date
     * @return  object
     * 
     */
    function GetReservations( string $date = '' )
    {
        if ( $this->conn )
        {            
            if ( $date == '' )
                $statement = $this->conn->prepare( 'SELECT * FROM planning p INNER JOIN clients c on p.client_id = c.id INNER JOIN chambres h on h.numero = p.chambre_id INNER JOIN tarifs t on h.tarif_id = t.id where reservation = -1 ORDER by debut DESC' );
            else
            {
                $statement = $this->conn->prepare( 'SELECT * FROM planning p INNER JOIN clients c on p.client_id = c.id INNER JOIN chambres h on h.numero = p.chambre_id INNER JOIN tarifs t on h.tarif_id = t.id where reservation = -1 AND :date between debut and fin ORDER by debut DESC' );
                $statement->bindParam(':date', $date );
            }

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
     * Récupère une réservations d'un chambre en base de donnée
     * 
     * @param   int $id    Numero de la réservation
     * @return  object
     * 
     */
    function GetReservation( int $id )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'SELECT * FROM planning p INNER JOIN clients c on p.client_id = c.id INNER JOIN chambres h on h.numero = p.chambre_id INNER JOIN tarifs t on h.tarif_id = t.id where tid = :id' );
            $statement->bindParam(':id', $id );

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
     * Récupère les réservations d'un utilisateur en base de donnée
     * 
     * @param   int $client_id    ID de client
     * @return  object
     * 
     */
    function GetReservationsByUser( int $client_id, string $date = '' )
    {
        if ( $this->conn )
        {
            if ( $date == '' )
                $statement = $this->conn->prepare( 'SELECT * FROM planning p INNER JOIN clients c on p.client_id = c.id INNER JOIN chambres h on h.numero = p.chambre_id INNER JOIN tarifs t on h.tarif_id = t.id where reservation = -1 and client_id = :client_id ORDER by debut DESC' );
            else
            {
                $statement = $this->conn->prepare( 'SELECT * FROM planning p INNER JOIN clients c on p.client_id = c.id INNER JOIN chambres h on h.numero = p.chambre_id INNER JOIN tarifs t on h.tarif_id = t.id where reservation = -1 and client_id = :client_id AND :date between debut and fin ORDER by debut DESC' );
                $statement->bindParam(':date', $date );
            }

            $statement->bindParam(':client_id', $client_id );

            if ( $statement->execute() )
            {
                $user = $statement->fetchAll( PDO::FETCH_OBJ );
                $statement->closeCursor();

                return $user;
            }
        }
    }
}

?>