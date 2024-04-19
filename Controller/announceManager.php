<?php

class AnnounceManager {
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

    public function addAnnounce (Announce $announce) {
        $req = $this->db->prepare("INSERT INTO announce (job, place, description) VALUES(:job, :place, :description)");
        $req->bindValue(':job', $announce->getJob());
        $req->bindValue(':place', $announce->getPlace());
        $req->bindValue('description', $announce->getPlace());
        $req->execute();
    }
}
