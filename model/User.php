<?php 

require_once ('Bdd.php');

class User extends Bdd 
{
    private  $id_user;
    public  $nom;
    public  $prenom;
    public  $email;
    public  $mdp;
    public  $role_id;

  

function __construct() {

        /*Est appelé automatiquement lors de l’initialisation de votre objet. Initialise les différents attributs de votre objet.*/
        
        parent::__construct($this->bdd);
        $id_user =  $this->id_user;
        $nom =  $this->nom;
        $prenom =  $this->prenom;
        $email =  $this->email;
        $mdp =  $this->mdp;
        $role_id =  $this->role_id;
       
}

//CREATE USER : insert un utilisateur en BDD
public function createUser($nom, $prenom, $email, $mdp, $role_id){
    //On écrit la requête
    $sql = "INSERT INTO admins (`nom`, `prenom`, `email`, `mdp`, `role_id`) VALUES (:nom, :prenom, ;email, :email, :mdp, :role_id)";
    //On prépare la requête
    $query = $this->bdd->prepare($sql);
    //On execute la requête
    $query->execute(array(':nom' => $nom, ':prenom' => $prenom, ':email' => $email, ':mdp' => $mdp, ':role_id' => $role_id));
}

//CHECK IF LOGIN EXIST : retourne un nombre de ligne en retour
public function checkLoginExist($email){
    $sql = "SELECT `email` FROM `admins`WHERE `email` LIKE :email";
    $query = $this->bdd->prepare($sql);
    $query->execute(array(':email' => $email));
    return $query->rowCount();
}

//CHECK IF USER EXIST WITH COMBO EMAIL/MDP : retourne un nombre de ligne en retour
public function checkUserExist($email, $mdp){
    $sql = "SELECT `email` FROM `admins`WHERE `email` LIKE :email AND `mdp` LIKE :mdp " ;
    $query = $this->bdd->prepare($sql);
    $query->execute(array(':email' => $email, ':mdp' => $mdp));
    return $query->rowCount();
}

//READ USER : retourne tous les utilisateurs en BDD
public function getAllUsers(){
    $sql = "SELECT * FROM admins";
    $query = $this->bdd->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}


//UPDATE
public function updateUser($nom, $prenom, $email, $mdp, $role_id){
    //On écrit la requête
    $sql = "UPDATE admins SET nom = :nom, prenom = :prenom, email = :email, mdp = :mdp, role_id = :role_idWHERE id_user = :id_user";
    //On prépare la requête
    $query = $this->bdd->prepare($sql);
    //On execute la requête
    $query->execute(array(':nom' => $nom, ':prenom' => $prenom, ':email' => $email, ':mdp' => $mdp, ':role_id' => $role_id));
} 

}