<?php 

session_start();

       require('./model/Admin.php');
       $bdd_admin = new Admin();

    if (isset($_GET['update_id'])) {

            $id = $_GET['update_id'];
            $user= $bdd_admin->fetchUser($id);

    }

    if (isset($_POST['btn_update'])) {

        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $email= htmlentities($_POST['email']);
        $mdp = htmlentities($_POST['mdp']);
 
        $bdd_admin->updateUser($id, $nom, $prenom, $email, $mdp);
        

        if (!isset($errorMsg)) {

            $password_hash= password_hash($mdp,PASSWORD_BCRYPT);
            
            $bdd_admin->updateUser($id, $nom, $prenom, $email, $password_hash);

            $UpdatetMsg = "Insertion réussie ! Vous allez être redirigé";


                header("refresh:1;index_admin.php");

                
            }
            

    }
    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification</title>

    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>

    <div class="container">
    <div class="display-3 text-center">Modifier le staff</div>

    <?php 
         if (isset($errorMsg)) {
    ?>
        <div class="alert alert-danger">
            <strong>Erreur ! <?php echo $errorMsg; ?></strong>
        </div>
    <?php } ?>
    

    <?php 
         if (isset($UpdateMsg)) {
    ?>
        <div class="alert alert-success">
            <strong>Réussie ! <?php echo $updateMsg; ?></strong>
        </div>
    <?php } ?>

    <form method="post" class="form-horizontal mt-5">
            
            <div class="form-group text-center">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">Nom</label>
                    <div class="col-sm-9">
                        <input type="text" name="nom" class="form-control" placeholder="Entrer le nom..." value="<?php echo $user['nom']; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">Prénom</label>
                    <div class="col-sm-9">
                        <input type="text" name="prenom" class="form-control" placeholder="Entrer le prénom..." value="<?php echo $user['prenom'];  ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="lastname" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" class="form-control"placeholder="Entrer l'email..."  value="<?php echo $user['email'];  ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="lastname" class="col-sm-3 control-label">Mot de passe</label>
                    <div class="col-sm-9">
                        <input type="password" name="mdp" class="form-control" placeholder="Entrer le mot de passe..." value="<?php echo $user['mdp'];  ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-md-12 mt-3">
                    <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                    <a href="index_admin.php" class="btn btn-danger">Annuler</a>
                </div>
            </div>


    </form>

   
</body>
</html>