<?php 

include_once CORE. "/database.php";

class Users
{
    var $conn;

    /**
     * 
     * Initialise une instance de gestionnaire d'utilisateur
     * 
     */
    function __construct()
    {
        $this->conn = Database::GetConnection();
    }

    /**
     * 
     * Crée un utilisateur en base de donnée
     * 
     * @param   object $user    Utilisateur à ajouter
     * @return  int
     * 
     */
    function Create( object $user )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( "INSERT INTO clients (civilite, nom, prenom, adresse, codePostal, ville, pays_id, motdepasse, identifiant, cle, confirme, admin) VALUES (:civilite, :nom, :prenom, :adresse, :codePostal, :ville, :pays, :motdepasse, :identifiant, :cle, :confirme, :admin)" );
            $statement->bindParam(':civilite', $user->civilite );
            $statement->bindParam(':nom', $user->nom );
            $statement->bindParam(':prenom', $user->prenom );
            $statement->bindParam(':codePostal', $user->codePostal );
            $statement->bindParam(':adresse', $user->adresse );
            $statement->bindParam(':ville', $user->ville );
            $statement->bindParam(':pays', $user->pays_id );
            $statement->bindParam(':identifiant', $user->identifiant );
            $statement->bindParam(':motdepasse', $user->motdepasse );
            $statement->bindParam(':cle', $user->cle );
            $statement->bindParam(':confirme', $user->confirme );
            $statement->bindParam(':admin', $user->admin );
            $statement->execute();
            
            return $this->conn->lastInsertId();
        }
    }

    /**
     * 
     * Supprime un utilisateur en base de donnée
     * 
     * @param   int $id    ID de l'utilisateur
     * @return  bool
     * 
     */
    function Delete( int $id )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'DELETE FROM clients where id = :id_client' );
            $statement->bindParam(':id_client', $id );

            return $statement->execute();
        }
    }

    /**
     * 
     * Récupère la liste des pays en base de donnée
     * 
     * @return object[]
     * 
     */
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

    /**
     * 
     * Récupère la liste des utilisateurs et permet la recherche par prénom ou nom en base de donnée
     * 
     * @return object[]
     * 
     */
    function GetUsers( string $search )
    {
        if ( $this->conn )
        {
            $search = "%$search%";
            $statement = $this->conn->prepare( 'SELECT * FROM clients WHERE prenom LIKE :search or nom LIKE :search or identifiant LIKE :search ORDER by id desc' );
            $statement->bindParam( ':search', $search );

            if ( $statement->execute() )
            {
                $users = $statement->fetchAll( PDO::FETCH_OBJ );
                $statement->closeCursor();

                return $users;
            }
        }
    }

    /**
     * 
     * Récupère une utilisateur à partir sont ID en base de donnée
     * 
     * @param   int $id    ID de l'utilisateur
     * @return  object
     * 
     */
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

    /**
     * 
     * Récupère une utilisateur à partir sa clé en base de donnée
     * 
     * @param   int $cle    Clé de l'utilisateur
     * @return  object
     * 
     */
    function GetUserByKey( string $cle )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( 'SELECT * FROM clients where cle = :cle' );
            $statement->bindParam(':cle', $cle );

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
     * Récupère une utilisateur par sont email en base de donnée
     * 
     * @param   string $email   Email de l'utilisateur
     * @return  object
     * 
     */
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

    /**
     * 
     * Mes à jour un utilisateur en base de donnée
     * 
     * @param   object $user    Utilisateur à mettre à jour
     * @return  bool
     * 
     */
    function Update( object $user )
    {
        if ( $this->conn )
        {
            $statement = $this->conn->prepare( "UPDATE clients SET civilite = :civilite, nom = :nom, prenom = :prenom, adresse = :adresse, codePostal = :codePostal, ville = :ville, pays_id = :pays_id, motdepasse = :motdepasse, identifiant = :identifiant, cle = :cle, confirme = :confirme, admin = :admin WHERE id = :id_client" );            
            $statement->bindParam(':civilite', $user->civilite );
            $statement->bindParam(':nom', $user->nom );
            $statement->bindParam(':prenom', $user->prenom );
            $statement->bindParam(':codePostal', $user->codePostal );
            $statement->bindParam(':adresse', $user->adresse );
            $statement->bindParam(':ville', $user->ville );
            $statement->bindParam(':pays_id', $user->pays_id );
            $statement->bindParam(':identifiant', $user->identifiant );
            $statement->bindParam(':motdepasse', $user->motdepasse );
            $statement->bindParam(':cle', $user->cle );
            $statement->bindParam(':confirme', $user->confirme );
            $statement->bindParam(':admin', $user->admin );
            $statement->bindParam(':id_client', $user->id );
            
            return $statement->execute();
        }
    }
}

?>