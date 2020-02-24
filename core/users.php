<?php 

require ROOT. "/core/database.php";

class Users
{
    var $conn;

    function __construct()
    {
        $this->conn = Database::GetConnection();
    }

    function GetUser( int $id )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'SELECT * FROM clients where id = :id_client' );
            $statement->bindParam(':id_client', $id);

            if ( $statement->execute() )
            {
                $user = $statement->fetch( PDO::FETCH_OBJ );
                $statement->closeCursor();

                return $user;
            }

            return null;
        }
    }

    function Create( string $email, string $password, string $civilite, string $nom, string $prenom, string $adresse, string $codePostal, string $ville, int $pays)
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( "INSERT INTO clients (civilite, nom, prenom, adresse, codePostal, ville, pays_id) VALUES (:civilite, :nom, :prenom, :adresse, :codePostal, :ville, :pays)" );            
            $statement->bindParam(':civilite', $civilite);
            $statement->bindParam(':nom', $nom);
            $statement->bindParam(':prenom', $prenom);
            $statement->bindParam(':adresse', $adresse);
            $statement->bindParam(':codePostal', $codePostal);
            $statement->bindParam(':ville', $ville);
            $statement->bindParam(':pays', $pays);
            $statement->execute();

            return $this->conn->lastInsertId();
        }
        
        return 0;
    }
}

?>