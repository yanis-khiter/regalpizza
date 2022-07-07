<?php

require_once ('Bdd.php');

class Produit extends Bdd {

public function getProduit(){

    $fetch = $this->getAll("produits");

    return $fetch;
}




}