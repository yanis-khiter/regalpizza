<?php

class Bdd {

    protected $bdd;

    function __construct(){

        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=regal;charset=utf8', 'root', '');
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Echec de la connexion : ' . $e->getMessage();
            exit;
        }
    }

 

}