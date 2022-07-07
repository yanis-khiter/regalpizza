<?php 
       require('./model/Bdd.php');

 

    if (isset($_SESSION['update_id'])) {
        try {
            $role_id = $_SESSION['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM admins WHERE id = :id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch(PDOException $e) {
            $e->getMessage();
        }
    }

    if (isset($_SESSION['btn_update'])) {
        $nom_up = $_SESSION['nom'];
        $prenom_up = $_SESSION['prenom'];
        $email_up = $_SESSION['email'];
        $mdp_up = $_SESSION['mdp'];
        $role_id_up = $_SESSION['role_id_up'];

        if (empty($nom_up)) {
            $errorMsg = "Entrez votre nom s'il vous plait";
        } else if (empty($prenom_up)) {
            $errorMsg = "Entrez votre prenom s'il vous plait";
        } else if (empty($email_up)) {
            $errorMsg = "Entrez votre email s'il vous plait";
        } else if (empty($email_up)) {
            $errorMsg = "Entrez votre ID s'il vous plait";
        } else if (empty($mdp_up)) {
            $errorMsg = "Entrez votre mot de passe s'il vous plait";
        } else if (empty($id_role)) {
            $errorMsg = "Entrez votre rôle s'il vous plait";
        } 
        else  {
            try {
                if (!isset($errorMsg)) {
                    $update_stmt = $db->prepare("UPDATE admins SET prenom = :prenom_up, nom = :nom_up, email = :email, mdp = :mdp_up, WHERE role_id = :role_id");
                    $update_stmt->bindParam(':nom_up', $nom_up);
                    $update_stmt->bindParam(':prenom_up', $prenom_up);  
                    $update_stmt->bindParam(':email_up', $email_up);
                    $update_stmt->bindParam(':mdp_up', $mdp_up);
                    $update_stmt->bindParam(':role_id', $role_id);

                    if ($update_stmt->execute()) {
                        $updateMsg = "Mise à jour réussie ! ";
                        header("refresh:2;index_admin.php");
                    }
                }
            } catch(PDOException $e) {
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
    <title>Modifier</title>

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
         if (isset($updateMsg)) {
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
                        <input type="text" name="nom" class="form-control" value="<?php echo $nom_up; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">Prénom</label>
                    <div class="col-sm-9">
                        <input type="text" name="prenom" class="form-control" value="<?php echo $prenom_up; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="lastname" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" class="form-control" value="<?php echo $email_up; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="lastname" class="col-sm-3 control-label">Mot de passe</label>
                    <div class="col-sm-9">
                        <input type="password" name="email" class="form-control" value="<?php echo $mdp_up; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="lastname" class="col-sm-3 control-label">Rôle ID</label>
                    <div class="col-sm-9">
                        <input type="number" name="id" class="form-control" value="<?php echo $role_id; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-md-12 mt-3">
                    <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                    <a href="index.php" class="btn btn-danger">Annuler</a>
                </div>
            </div>


    </form>

   
</body>
</html>