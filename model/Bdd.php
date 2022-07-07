<?php

class Bdd {

    public $bdd;

    function __construct(){

        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=regal;charset=utf8', 'root', '');
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Echec de la connexion : ' . $e->getMessage();
            exit;
        }
    }



    public function getAll($database){

        $stmt=$this->bdd->prepare("SELECT * FROM $database");
        $stmt->execute();
        $fetch=$stmt->fetchAll();
    
        return $fetch;
    }


}