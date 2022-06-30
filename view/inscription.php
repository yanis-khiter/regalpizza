

<?php 
require_once ("../models/user.php");
$user = new User();

if(isset($_POST['submit'])){

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $mdpconfirm = $_POST['mdpconfirm'];
    $role_id = $_POST['role_id'];


    if(!empty($email) && !empty($mdp) && !empty($mdpconfirm)){
        if($user->checkLoginExist($email) === 0){
            if($mdp === $mdpconfirm){
                $user->createUser($email, $mdp);
                header('location:index.php');
            }else{
                echo 'Les mots de passes ne correspondent pas';
            }
        }else{
            echo 'Ce login existe déjà';
        }
    }else{
        echo 'Veuillez remplir tous les champs';
    }

}


     // NOM

     if (empty($nom)) {
        $valid = false;
        $err_nom = "Renseignez votre nom.";
    }

    elseif (!preg_match("#^[a-zA-Z]+$#", $nom)) {
        $valid = false;
        $err_nom = "Votre nom ne doit pas contenir de chiffres ou de caractères spéciaux.";
        $nom ="";
    }

    

    // PRENOM

    if (empty($prenom)) {
        $valid = false;
        $err_prenom = "Renseignez votre prénom.";
    }

    elseif (!preg_match("#^[a-zA-Z]+$#", $prenom)) {
        $valid = false;
        $err_prenom ="Votre prénom ne doit pas contenir de chiffres ou de caractères spéciaux.";
        $prenom ="";
    }


    // EMAIL


  $reqmail = $bdd->prepare("SELECT * FROM admins WHERE email =:email");
  $reqmail->setFetchMode(PDO::FETCH_ASSOC);
  $reqmail->execute(['email'=>$email]);

  $resultmail = $reqmail->fetch();

  if (empty($email)) {
      $valid=false;
      $err_email = "Renseignez l'email.";
  }

  elseif(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
      $valid=false;
      $err_email = "Votre email n'est pas au bon format";
      $email="";
  }

  elseif ($resultmail) {
      $valid = false;
      $err_email = "Cette adresse mail est déjà utilisée.";
      $email ="";
  }

    // ! MOT DE PASSE

    if (empty($mdp)) {
        $valid = false;
        $err_mdp = "Renseignez votre mot de passe.";
    } elseif (strlen($mdp)<8) {
        $valid = false;
        $err_mdp = "Le mot de passe doit être de 8 caractères minimum.";
        $mdp="";
    } elseif (empty($mdpconfirm)) {
        $valid = false;
        $err_mdpconfirm = "Confirmez votre mot de passe.";
    } elseif ($mdp !== $mdpconfirm) {
        $valid = false;
        $err_mdpconfirm = "Les mots de passe ne sont pas identiques.";
        $mdpconfirm ="";

    } else {
        $mdp = password_hash($mdp, PASSWORD_DEFAULT);
    }
    



?>   


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/inscription.css">
    <title>Inscription staff</title>
</head>
<body>

<main>

<h1 class="h1inscri">INSCRIPTION</h1>

    <div class="box-inscri">

            <form method ="post" action = "inscription.php" class="formito" >
            
                <div class="info">

                    <label>NOM</label> 
                    <?php if (isset($err_nom)) {echo "<div class='error'> $err_nom</div>";}?>
                    <input type="text" name="nom" placeholder='James' required>

                    <label>PRENOM</label>
                    <?php if (isset($err_prenom)) {echo "<div class='error'> $err_prenom</div>";}?>
                    <input type="text" name="prenom" placeholder='Adam' required>

                    <label>EMAIL</label>
                    <?php if (isset($err_email)) {echo "<div class='error'> $err_email</div>";}?> 
                    <input type="email" name="email" placeholder='Adam@gmail.com' required>

                    <label>MOT DE PASSE</label> 
                    <?php if (isset($err_mdp)) {echo "<div class='error'> $err_mdp</div>";}?>
                    <input type="password" name="mdp" placeholder='*****' required>

                    <label>CONFIRMATION MOT DE PASSE</label> 
                    <?php if (isset($err_mdpconfirm)) {echo "<div class='error'> $err_mdpconfirm</div>";}?>
                    <input type="password" name="mdpconfirm" placeholder='*****' required>
            
                </div>

                <div id="buttoncon"> <input class="inputinside" name="suscribe" type="submit" value="S'inscrire"> </div> 

            </form>

</main>

<body>
</html>