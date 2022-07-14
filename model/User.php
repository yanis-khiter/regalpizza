<?php 

require_once ('Bdd.php');

class User extends Bdd 
{
    private  $id;
    public  $nom;
    public  $prenom;
    public  $email;
    public  $mdp;


function __construct() {

        /*Est appelé automatiquement lors de l’initialisation de votre objet. Initialise les différents attributs de votre objet.*/
        
        parent::__construct($this->bdd);
        $id =  $this->id;
        $nom =  $this->nom;
        $prenom =  $this->prenom;
        $email =  $this->email;
        $mdp =  $this->mdp;

       
}


//CHECK IF LOGIN EXIST : retourne un nombre de ligne en retour
public function checkLoginExist($email){
    $sql = "SELECT `email` FROM `admins`WHERE `email` = :email";
    $query = $this->bdd->prepare($sql);
    $query->execute(array(':email' => $email));
    return $query->rowCount();
}

//CHECK IF USER EXIST WITH COMBO EMAIL/MDP : retourne un nombre de ligne en retour
public function checkUserExist($email, $mdp){

    $sql = "SELECT `email` FROM `admins`WHERE `email` = :email " ;
    $query = $this->bdd->prepare($sql);
    $query->execute(array(':email' => $email));
    $count =  $query->rowCount();

    return $count;
 
}

//READ USER : retourne tous les utilisateurs en BDD
public function getAllUsers(){
    $sql = "SELECT * FROM admins";
    $query = $this->bdd->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

public function getUserByEmail($email){
    $sql = "SELECT * FROM `admins`WHERE `email` = :email " ;
    $query = $this->bdd->prepare($sql);
    $query->execute(array(':email' => $email));

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;

}


}