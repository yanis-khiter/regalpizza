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



public function deleteCategorie($id){
    $delete_stmt = $this->bdd->prepare('DELETE FROM categories WHERE id_categorie = :id_categorie');
    $delete_stmt->execute([':id_categorie' => $id]);
}


public function fetchUser($id_categorie){
    $id_categorie = $_GET['update_id'];
    $select_stmt = $this->bdd->prepare("SELECT * FROM categories WHERE id_categorie = :id_categorie");
    $select_stmt->execute([':id_categorie'=>$id_categorie]);
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

public function updateCategorie($id_categorie,$nom_categorie, $image_categorie, $description_categorie){

            if (empty($nom_categorie)) {
            $errorMsg = "Entrez votre nom s'il vous plait";
        } else if (empty($image_categorie)) {
            $errorMsg = "Entrez votre image s'il vous plait";
        } else if (empty($description_categorie)) {
            $errorMsg = "Entrez votre description s'il vous plait";
        } else  {
            
            try {
      
                if (!isset($errorMsg)) {

                    $update_stmt = $this->bdd->prepare("UPDATE categories SET nom_categorie = :nom_categorie, image_categorie = :image_categorie, description_categorie = :description_categorie WHERE id_categorie = :id_categorie");


                    if ($update_stmt->execute(['nom_categorie'=>$nom_categorie, 'image_categorie'=>$image_categorie, 'description_categorie'=>$description_categorie,'id_categorie'=>$id_categorie])) {
                        $UpdateMsg = "Mise à jour réussie ! ";
                        header("refresh:2;index_categories.php");
                    }
                }
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

}



}

