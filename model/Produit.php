<?php

require_once ('Bdd.php');

class Produit extends Bdd {

public function getProduit(){

    $fetch = $this->getAll("produits");

    return $fetch;
}


public function createProduit($nom_produit, $categorie_id, $prix_produit, $ingredient_produit, $image_produit, $date_creation) {


    $sql = "INSERT INTO produits (`nom_produit`, `categorie_id`, `prix_produit`, 
                                    `ingredient_produit`, `image_produit`, `date_creation`) 
            VALUES (    :nom_produit, 
                        :categorie_id, 
                        :prix_produit, 
                        :ingredient_produit, 
                        :image_produit, 
                        :date_creation)";

    $query = $this->bdd->prepare($sql);

    $query->execute(array(  ':nom_produit' => $nom_produit, 
                            ':categorie_id' => $categorie_id, 
                            ':prix_produit' => $prix_produit, 
                            ':ingredient_produit' => $ingredient_produit, 
                            ':image_produit' => $image_produit, 
                            ':date_creation' => $date_creation));

    $fetch=$query->fetch(PDO::FETCH_ASSOC);

    return $fetch;
}

public function deleteProduit($id){
    $delete_stmt = $this->bdd->prepare('DELETE FROM produits WHERE id_produit = :id_produit');
    $delete_stmt->execute([':id_produit' => $id]);
}



public function fetchUser($id_produit){
    $id_produit = $_GET['update_id'];
    $select_stmt = $this->bdd->prepare("SELECT * FROM produits WHERE id_produit = :id_produit");
    $select_stmt->execute([':id_produit'=>$id_produit]);
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

public function updateProduit($id_produit, $nom_produit, $categorie_id, $prix_produit, $ingredient_produit, $image_produit, $date_creation){

    if (empty($nom_produit)) {
    $errorMsg = "Entrez votre nom s'il vous plait";
} else if (empty($categorie_id)) {
    $errorMsg = "Entrez votre catégorie s'il vous plait";
} else if (empty($prix_produit)) {
    $errorMsg = "Entrez votre prix s'il vous plait";
} else if (empty($ingredient_produit)) {
    $errorMsg = "Entrez vos ingrédients s'il vous plait";
} else if (empty($image_produit)) {
    $errorMsg = "Entrez votre image s'il vous plait";
} else if (empty($date_creation)) {
    $errorMsg = "Entrez votre date s'il vous plait";
} else  {
    try {

        if (!isset($errorMsg)) {

            $update_stmt = $this->bdd->prepare("UPDATE produits SET nom_produit = :nom_produit, categorie_id = :categorie_id, prix_produit = :prix_produit, ingredient_produit = :ingredient_produit, image_produit = :image_produit, date_creation = :date_creation WHERE id_produit = :id_produit");


            if ($update_stmt->execute([
            ':nom_produit' => $nom_produit, 
            ':categorie_id' => $categorie_id, 
            ':prix_produit' => $prix_produit, 
            ':ingredient_produit' => $ingredient_produit, 
            ':image_produit' => $image_produit, 
            ':date_creation' => $date_creation,
            ':id_produit' => $id_produit])
            ) {
                $UpdateMsg = "Mise à jour réussie ! ";
                header("refresh:2;index_produits.php");
            }
        }
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}

}






}

