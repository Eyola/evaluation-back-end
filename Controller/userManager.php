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
                  email, password, status_id) 
                    VALUES (
                           :email, :password, :status_id)");
        $req->bindValue(':email', $user->getEmail());
        $req->bindValue(':password', password_hash($user->getPassword(), PASSWORD_BCRYPT));
        $req->bindValue(':status_id', $user->getStatusId());
        $req->execute();
    }

    public function connectUser(string $email, string $password)
    {
    $req = $this->db->prepare("SELECT * FROM user WHERE email = :email");
    $req->bindValue(':email', $email, PDO::PARAM_STR);
    if ($req->execute()) {
        $user = $req->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $user["password"])) {
            echo 'Bonjour' . ' ' . $user["first_name"] . ' ' . $user["last_name"];
            $_SESSION['email'] = $user["email"];
            $_SESSION['firstName'] = $user["first_name"];
            $_SESSION['lastName'] = $user["last_name"];
            if ($user['status_id'] == 1) {
                $_SESSION['status'] = 'Recruteur';
            } else if ($user['status_id'] == 2) {
                $_SESSION['status'] = 'Candidat';
            } else if ($user['status_id'] == 3) {
                $_SESSION['status'] = 'Consultant';
            } else if ($user['status_id'] == 4) {
                $_SESSION['status'] = 'Administrateur';
            }
        } else {
            echo 'Identifiants invalides';
        }
    }
    return $req->execute();
    }

    public function showUsers()
    {
        $users = [];
        $req = $this->db->query("SELECT id, first_name AS firstName, last_name AS lastName, email, status_id AS statusId, approved FROM user ORDER BY last_name");
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $user = new User($data);
            $users[] = $user;
        } return $users;
    }

    public function changeApproved(int $id, string $approved)
    {
        $req = $this->db->prepare("UPDATE user SET approved = '$approved' WHERE id = $id");
        $req->execute();
    }

    public function addConsultant(User $user)
    {
        $req = $this->db->prepare("INSERT INTO user (first_name, last_name, email, password, status_id, approved) VALUES (:first_name, :last_name, :email, :password, :status_id, :approved)");
        $req->bindValue(':first_name', $user->getFirstName());
        $req->bindValue(':last_name', $user->getLastName());
        $req->bindValue(':email', $user->getEmail());
        $req->bindValue(':password', password_hash($user->getPassword(), PASSWORD_BCRYPT));
        $req->bindValue(':status_id', 3);
        $req->bindValue(":approved", 'Oui');
        $req->execute();
    }

    public function updatePrivate(User $user)
    {
        $req = $this->db->prepare("UPDATE user SET first_name = :firstName, last_name = :lastName, cv = :cv, business = :business, address = :address WHERE id = :id");
        $req->bindValue(':id', $user->getId());
        $req->bindValue(':firstName', $user->getFirstName());
        $req->bindValue(':lastName', $user->getLastName());
        $req->bindValue(':cv', $user->getCv());
        $req->bindValue(':business', $user->getBusiness());
        $req->bindValue(':address', $user->getAddress());
        $req->execute();
    }

}