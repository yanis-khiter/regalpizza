
<?php

session_start();

require_once ("../model/User.php");

$user = new User();


if(isset($_POST['connect'])){

    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    if(!empty($email) && !empty($mdp)){
        // $check_password=password_verify($mdp,$);
        if($user->checkUserExist($email, $mdp) === 1){
            $_SESSION['email'] = $email;

            header('location:index_admin.php');

        }else{
            echo 'Erreur de login ou de mot de passe';
        }
    }else{
        echo 'Veuillez remplir tous les champs';
    }

  

    // EMAIL

 
    if (empty($email)) {
        $valid=false;
        $err_email = "Renseignez l'email.";
    }

    elseif(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $valid=false;
        $err_email = "Votre email n'est pas au bon format";
        $email="";
    }



    // ! MOT DE PASSE

    if (empty($mdp)) {
        $valid = false;
        $err_mdp = "Renseignez votre mot de passe.";
    } elseif (strlen($mdp)<8) {
        $valid = false;
        $err_mdp = "Le mot de passe doit être de 8 caractères minimum.";
        $mdp="";
    } else {
        $mdp = password_hash($mdp, PASSWORD_DEFAULT);
    }

}
    


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/connexion.css">
    <title>Connexion staff</title>
</head>
<body>

<main> 
        

        <h1 class="h1conn">CONNEXION</h1>

        <form method="post" action="" class="formi">


            <div class="conni">

                <?php if (isset($erreur)) {
                    echo "<div class='error'>" . $erreur . "</div>";
                } ?>

                    <label>EMAIL</label>
                    <?php if (isset($err_email)) {echo "<div class='error'> $err_email</div>";}?> 
                    <input type="email" name="email" placeholder='Adam@gmail.com' required>

                    <label>MOT DE PASSE</label> 
                    <?php if (isset($err_mdp)) {echo "<div class='error'> $err_mdp</div>";}?>
                    <input type="password" name="mdp" placeholder='*****' required>


            <div id="buttoncon"> <input class="inputinside" type="submit" name="connect" value="Se connecter"> </div>


        </form>

    </main>


    <body>
</html> 