<?php

require_once ('Bdd.php');

class Admin extends Bdd {


public function getAdmin(){

    $stmt=$this->bdd->prepare("SELECT * FROM admins");
    $stmt->execute();
    $fetch=$stmt->fetch();

    return $fetch;
}


}