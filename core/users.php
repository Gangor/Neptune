<?php 

require CORE. "/database.php";

class Users
{
    var $conn;

    function __construct()
    {
        $this->conn = Database::GetConnection();
    }

    function Create( array $user )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( "INSERT INTO clients (civilite, nom, prenom, adresse, codePostal, ville, pays_id, motdepasse, identifiant, cle, confirme, admin) VALUES (:civilite, :nom, :prenom, :adresse, :codePostal, :ville, :pays, :motdepasse, :identifiant, :cle, :confirme, :admin)" );
            $statement->bindParam(':civilite', $user [ 'civilite' ] );
            $statement->bindParam(':nom', $user [ 'nom' ] );
            $statement->bindParam(':prenom', $user [ 'prenom' ] );
            $statement->bindParam(':codePostal', $user [ 'codePostal' ]);
            $statement->bindParam(':adresse', $user [ 'adresse' ] );
            $statement->bindParam(':ville', $user [ 'ville' ] );
            $statement->bindParam(':pays', $user [ 'pays' ] );
            $statement->bindParam(':identifiant', $user [ 'identifiant' ] );
            $statement->bindParam(':motdepasse', $user [ 'motdepasse' ] );
            $statement->bindParam(':cle', $user [ 'cle' ] );
            $statement->bindParam(':confirme', $user [ 'confirme' ] );
            $statement->bindParam(':admin', $user [ 'admin' ] );
            $statement->execute();
            
            return $this->conn->lastInsertId();
        }
        
        return 0;
    }

    function Delete( int $id )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'DELETE FROM clients where id = :id_client' );
            $statement->bindParam(':id_client', $id );

            return $statement->execute();
        }
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
        }
    }

    function Update( array $user )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( "UPDATE clients SET civilite = :civilite, nom = :nom, prenom = :prenom, adresse = :adresse, codePostal = :codePostal, ville = :ville, pays_id = :pays_id, motdepasse = :motdepasse, identifiant = :identifiant, cle = :cle" );            
            $statement->bindParam(':civilite', $user [ 'civilite' ] );
            $statement->bindParam(':nom', $user [ 'nom' ] );
            $statement->bindParam(':prenom', $user [ 'prenom' ] );
            $statement->bindParam(':codePostal', $user [ 'codePostal' ]);
            $statement->bindParam(':adresse', $user [ 'adresse' ] );
            $statement->bindParam(':ville', $user [ 'ville' ] );
            $statement->bindParam(':pays', $user [ 'pays' ] );
            $statement->bindParam(':identifiant', $user [ 'identifiant' ] );
            $statement->bindParam(':motdepasse', $user [ 'motdepasse' ] );
            $statement->bindParam(':cle', $user [ 'cle' ] );
            
            return $statement->execute();
        }
        
        return 0;
    }
}

?>