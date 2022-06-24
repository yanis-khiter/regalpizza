<!-- <?php

require_once(__DIR__ . '/../database/DB.php');

if (isset($_POST['connexion'])) {

    $email = htmlspecialchars($_POST['email']);
    $mdp = $_POST['mdp'];

    if (empty($email) or empty($mdp)) { {
            $erreur = "Tous les champs doivent être complétés !";
        }
    }

    elseif (!empty($email) and !empty($mdp)) {

    
            if (password_verify($mdp, $email)) {
                $_SESSION['email'] = $user[0]['email'];
                $_SESSION['mdp'] = $user[0]['mdp'];
                $_SESSION['role_id'] = $user[0]['role_id'];
            } 

                  
        } else {
            $erreur = "Email ou Mot de passe incorrect !";
        }

        } else {
            header('Location: index.php?succes=true');  
        }
    
  
      
          
    
    


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/connexion.css">
    <title>Inscription staff</title>
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
                <input type="email" name="email" placeholder='Arthur@gmail.com'>

                <label>MOT DE PASSE </label>
                <input type="password" name="mdp" placeholder='*****'>
            </div>

            <div id="buttoncon"> <input class="inputinside" type="submit" name="connexion" value="Se connecter"> </div>


        </form>

    </main>


    <body>
</html> -->