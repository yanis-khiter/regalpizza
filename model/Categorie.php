<?php

require_once ('Bdd.php');

class Categorie extends Bdd {

public function getCategorie(){

    $fetch = $this->getAll("categories");

    return $fetch;
}


public function createCategorie($nom_categorie, $image_categorie, $description_categorie) {

    $sql = "INSERT INTO produits (`nom_categorie`, `image_categorie`, `description_categorie`,) 
            VALUES (:nom_categorie, :image_categorie, :description_categorie,)";

    $query = $this->bdd->prepare($sql);

    $query->execute(array(  ':nom_categorie' => $nom_categorie, 
                            ':image_categorie' => $image_categorie, 
                            ':description_categorie' => $description_categorie,));

    $fetch=$query->fetch(PDO::FETCH_ASSOC);

    return $fetch;
}

}

