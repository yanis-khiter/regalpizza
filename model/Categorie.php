<?php

require_once ('Bdd.php');

class Categorie extends Bdd {

public function getCategorie(){

    $fetch = $this->getAll("categories");

    return $fetch;
}




}