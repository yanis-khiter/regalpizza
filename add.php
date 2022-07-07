<?php 
    require('./model/Admin.php');

    $bdd_categorie = new Admin();

    if (isset($_POST['btn_insert'])) {

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $role_id = $_POST['role_id'];

        if (empty($nom)) {
            $errorMsg = "Entrez votre nom s'il vous plait";
        } else if (empty($prenom)) {
            $errorMsg = "Entrez votre prenom s'il vous plait";
        }else if (empty($email)) {
            $errorMsg = "Entrez votre email s'il vous plait";
        }else if (empty($mdp)) {
            $errorMsg = "Entrez votre mdp s'il vous plait";
        } else if (empty($role_id)) {
            $errorMsg = "Entrez le rôle s'il vous plait";
        } else {
  
            try {
      
                if (!isset($errorMsg)) {
                    $password_hash= password_hash($mdp,PASSWORD_BCRYPT);
                    
                    $bdd_categorie->createUser($nom, $prenom, $email, $password_hash, $role_id);

                    $insertMsg = "Insertion réussie ! Vous allez être redirigé";


                        header("refresh:2;index_admin.php");
                    }
                }
             catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>

    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>

    <div class="container">
    <div class="display-3 text-center">Ajouter</div>

    <?php 
         if (isset($errorMsg)) {
    ?>
        <div class="alert alert-danger">
            <strong>Erreur ! <?= $errorMsg; ?></strong>
        </div>
    <?php } ?>
    

    <?php 
         if (isset($insertMsg)) {
    ?>
        <div class="alert alert-success">
            <strong>Réussie ! <?=$insertMsg; ?></strong>
        </div>
    <?php } ?>

    <form method="post" class="form-horizontal mt-5">
            
            <div class="form-group text-center">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">Nom</label>
                    <div class="col-sm-9">
                        <input type="text" name="nom" class="form-control" placeholder="Entrer le nom...">
                    </div>
                </div>
            </div> <div class="form-group text-center">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">Prénom</label>
                    <div class="col-sm-9">
                        <input type="text" name="prenom" class="form-control" placeholder="Entrer le prénom...">
                    </div>
                </div>
            </div> <div class="form-group text-center">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" class="form-control" placeholder="Entrer l'email...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">Mot de passes</label>
                    <div class="col-sm-9">
                        <input type="password" name="mdp" class="form-control" placeholder="Entrer le nom...">
                    </div>
                </div>
            </div> <div class="form-group text-center">
            <div class="form-group text-center">
                <div class="row">
                    <label for="lastname" class="col-sm-3 control-label">Rôle ID</label>
                    <div class="col-sm-9">
                        <input type="number" name="role_id" class="form-control" placeholder="Entrer le rôle de l'ID...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-md-12 mt-3">
                    
                    <input type="submit" name="btn_insert" class="btn btn-success" value="Insérer">
                    <a href="index_admin.php" class="btn btn-danger">Annuler</a>
                </div>
            </div>


    </form>


</body>
</html>