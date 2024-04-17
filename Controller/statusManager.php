<?php

require_once '../models/statusModel.php';
class StatusManager
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

    public function getStatusForRegister()
    {
        $status = [];
        $recrut = 'Recruteur';
        $candid = 'Candidat';
        $req = $this->db->prepare("SELECT * FROM status WHERE status_name = :statusName1 OR status_name = :statusName2");
        $req->bindValue(':statusName1', $recrut);
        $req->bindValue(':statusName2', $candid);
        $req->execute();
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $statu = new Status($data);
            $status[] = $statu;
        }
        return $status;
    }

    public function getStatusFromId(int $id)
    {
        $req = $this->db->query("SELECT * FROM status WHERE id = $id");
        $datas = $req->fetch();
        $status = new Status($datas);
        return $status->getStatus_name();
    }

}