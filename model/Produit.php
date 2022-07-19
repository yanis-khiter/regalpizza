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









public function updateProduit($id_produit, $nom_produit, $categorie_id, $prix_produit, $ingredient_produit, $image_produit){

            $update_stmt = $this->bdd->prepare("UPDATE produits SET nom_produit = :nom_produit, categorie_id = :categorie_id, prix_produit = :prix_produit, ingredient_produit = :ingredient_produit, image_produit = :image_produit WHERE id_produit = :id_produit");

            $arg = [
                ':nom_produit' => $nom_produit, 
                ':categorie_id' => $categorie_id, 
                ':prix_produit' => $prix_produit, 
                ':ingredient_produit' => $ingredient_produit, 
                ':image_produit' => $image_produit, 
                ':id_produit' => $id_produit];

            if ($update_stmt->execute($arg)) {
                $UpdateMsg = "Mise à jour réussie ! ";
                header("refresh:1;index_produits.php");
            }
     
}








}

