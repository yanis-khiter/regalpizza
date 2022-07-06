<?php 
    require_once('./model/Bdd.php');

    if (isset($_SESSION['btn_insert'])) {
        $nom = $_SESSION['nom'];
        $prenom = $_SESSION['prenom'];
        $email = $_SESSION['email'];
        $id = $_SESSION['id'];

        if (empty($nom)) {
            $errorMsg = "Entrez votre nom s'il vous plait";
        } else if (empty($prenom)) {
            $errorMsg = "Entrez votre prenom s'il vous plait";
        } else if (empty($email)) {
            $errorMsg = "Entrez votre email s'il vous plait";
        } else if (empty($role_id)) {
            $errorMsg = "Entrez votre ID s'il vous plait";
        } else {
            try {
                if (!isset($errorMsg)) {
                    $insert_stmt = $this->$bdd->prepare("INSERT INTO admins(nom, prenom, email, role_id) VALUES (:nom, :prenom, :email, :role_id )");
                    $insert_stmt->bindParam(':nom', $nom);
                    $insert_stmt->bindParam(':prenom', $prenom);
                    $insert_stmt->bindParam(':email', $email);
                    $insert_stmt->bindParam(':role_id', $role_id);

                    if ($insert_stmt->execute()) {
                        $insertMsg = "Insertion réussie...";
                        header("refresh:2;index_admin.php");
                    }
                }
            } catch (PDOException $e) {
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
            <strong>Erreur ! <?php echo $errorMsg; ?></strong>
        </div>
    <?php } ?>
    

    <?php 
         if (isset($insertMsg)) {
    ?>
        <div class="alert alert-success">
            <strong>Réussie ! <?php echo $insertMsg; ?></strong>
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
                    <label for="lastname" class="col-sm-3 control-label">Rôle ID</label>
                    <div class="col-sm-9">
                        <input type="number" name="id" class="form-control" placeholder="Entrer le rôle de l'ID...">
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