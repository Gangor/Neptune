<?php 

include_once CORE. "/database.php";

class Tarifs
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
     * Crée un tarif en base de donnée
     * 
     * @param   object $chambre    Chambre à ajouter
     * @return  int
     * 
     */
    function Create( object $tarif )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( "INSERT INTO tarifs (prix) VALUES (:prix)" );            
            $statement->bindParam(':prix', $tarif->prix );
            $statement->execute();

            return $this->conn->lastInsertId();
        }
    }

    /**
     * 
     * Supprime un tarif en base de donnée
     * 
     * @param   int $id    ID du tarif
     * @return  bool
     * 
     */
    function Delete( int $id )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'DELETE FROM tarifs where id = :id' );
            $statement->bindParam(':id', $id );
            
            return $statement->execute();
        }
    }

    /**
     * 
     * Récupère un tarif par sont id en base de donnée
     * 
     * @param   int $id  ID du tarif
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
    function GetTarifs( $fetch = NULL )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'SELECT * FROM tarifs order by prix' );

            if ( $statement->execute() )
            {
                $tarifs = $statement->fetchAll( $fetch );
                $statement->closeCursor();

                return $tarifs;
            }
        }
    }

    /**
     * 
     * Mes à jour un tarif en base de donnée
     * 
     * @param   object $chambre    Chambre à mettre à jour
     * @return  bool
     * 
     */
    function Update( object $tarif )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( "UPDATE tarifs SET prix = :prix WHERE id = :id" );
            $statement->bindParam(':prix', $tarif->prix );
            $statement->bindParam(':id', $tarif->id );

            
            return $statement->execute();
        }
    }
}

?>