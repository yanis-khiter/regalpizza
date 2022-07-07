<?php

require_once ('Bdd.php');

class Admin extends Bdd {

public function getAdmin(){

    $fetch = $this->getAll("admins");

    return $fetch;
}




//CREATE USER : insert un utilisateur en BDD
public function createUser($nom, $prenom, $email, $mdp, $role_id){
    //On écrit la requête
    $sql = "INSERT INTO admins (`nom`, `prenom`, `email`, `mdp`, `role_id`) VALUES (:nom, :prenom, :email, :mdp, :role_id)";
    //On prépare la requête
    $query = $this->bdd->prepare($sql);
    //On execute la requête
    $query->execute(array(':nom' => $nom, ':prenom' => $prenom, ':email' => $email, ':mdp' => $mdp, ':role_id' => $role_id));

    $fetch=$query->fetch(PDO::FETCH_ASSOC);

    return $fetch;
}

}