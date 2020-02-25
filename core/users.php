<?php 

require ROOT. "/core/database.php";

class Users
{
    var $conn;

    function __construct()
    {
        $this->conn = Database::GetConnection();
    }

    function Create( string $identifiant, string $motdepasse, string $civilite, string $nom, string $prenom, string $adresse, string $codePostal, string $ville, int $pays)
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( "INSERT INTO clients (civilite, nom, prenom, adresse, codePostal, ville, pays_id, motdepasse, identifiant) VALUES (:civilite, :nom, :prenom, :adresse, :codePostal, :ville, :pays, :motdepasse, :identifiant)" );            
            $statement->bindParam(':identifiant', $identifiant);
            $statement->bindParam(':motdepasse', sha1( $motdepasse ));
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

    function GetPays()
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'SELECT * FROM pays' );

            if ( $statement->execute() )
            {
                $pays = $statement->fetchAll( );
                $statement->closeCursor();

                return $pays;
            }

            return null;
        }
    }

    function GetUserById( int $id )
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

    function GetUserByEmail( string $email )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'SELECT * FROM clients where identifiant = :identifiant' );
            $statement->bindParam( ':identifiant', $email );

            if ( $statement->execute() )
            {
                $user = $statement->fetch( PDO::FETCH_OBJ );
                $statement->closeCursor();

                return $user;
            }

            return null;
        }
    }
}

?>