<?php

require_once ('Bdd.php');

class Admin extends Bdd {

public function getAdmin(){

    $fetch = $this->getAll("admins");

    return $fetch;
}



//CREATE USER : insert un utilisateur en BDD
public function createUser($nom, $prenom, $email, $mdp){
    //On écrit la requête
    $sql = "INSERT INTO admins (`nom`, `prenom`, `email`, `mdp`) VALUES (:nom, :prenom, :email, :mdp)";
    //On prépare la requête
    $query = $this->bdd->prepare($sql);
    //On execute la requête
    $query->execute(array(':nom' => $nom, ':prenom' => $prenom, ':email' => $email, ':mdp' => $mdp));

    $fetch=$query->fetch(PDO::FETCH_ASSOC);

    return $fetch;
}



public function deleteAdmin($id){
    $delete_stmt = $this->bdd->prepare('DELETE FROM admins WHERE id = :id');
    $delete_stmt->execute([':id' => $id]);
}


public function fetchUser($id){
    $id = $_GET['update_id'];
    $select_stmt = $this->bdd->prepare("SELECT * FROM admins WHERE id = :id");
    $select_stmt->execute([':id'=>$id]);
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

public function updateUser($id, $nom, $prenom, $email, $mdp){

            if (empty($nom)) {
            $errorMsg = "Entrez votre nom s'il vous plait";
        } else if (empty($prenom)) {
            $errorMsg = "Entrez votre prenom s'il vous plait";
        } else if (empty($email)) {
            $errorMsg = "Entrez votre email s'il vous plait";
        } else if (empty($email)) {
            $errorMsg = "Entrez votre ID s'il vous plait";
        } else if (empty($mdp)) {
            $errorMsg = "Entrez votre mot de passe s'il vous plait";
        } else  {
            try {
      
                if (!isset($errorMsg)) {

                    $update_stmt = $this->bdd->prepare("UPDATE admins SET prenom = :prenom, nom = :nom, email = :email, mdp = :mdp WHERE id = :id");


                    if ($update_stmt->execute(['nom'=>$nom, 'prenom'=>$prenom, 'email'=>$email, 'mdp'=>$mdp, 'id'=>$id])) {
                        $UpdateMsg = "Mise à jour réussie ! ";
                        header("refresh:2;index_admin.php");
                    }
                }
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

}



}

