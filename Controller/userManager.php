<?php

require_once '../models/userModel.php';

class UserManager
{
    private PDO $db;
    public function __construct()
    {
        $dbName = 'trt_conseil';
        $port = "3306";
        $userName = "root";
        try {
            $this->db = new PDO("mysql:host=localhost; dbname=$dbName; port=$port", $userName, "");
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "La connexion à la base de donnée a échouée.";
        }
    }
    public function addUser(User $user) {
        $req = $this->db->prepare("INSERT INTO user (
                  first_name, last_name, email, password, cv, business, address, status_id) 
                    VALUES (
                            :first_name, :last_name, :email, :password, :cv, :business, :address, :status_id)");
        $req->bindValue(':first_name', $user->getFirstName());
        $req->bindValue(':last_name', $user->getLastName());
        $req->bindValue(':email', $user->getEmail());
        $req->bindValue(':password', password_hash($user->getPassword(), PASSWORD_BCRYPT));
        $req->bindValue(':cv', $user->getCv());
        $req->bindValue(':business', $user->getBusiness());
        $req->bindValue(':address', $user->getAddress());
        $req->bindValue(':status_id', $user->getStatusId());
        $req->execute();
    }
}