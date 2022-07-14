<?php 

session_start();

       require('./model/Categorie.php');
       $bdd_categorie = new Categorie();

    if (isset($_GET['update_id'])) {

            $id_categorie = $_GET['update_id'];
            $user= $bdd_categorie->fetchUser($id_categorie);

    }

    if (isset($_POST['btn_update'])) {

        $nom_categorie = htmlentities($_POST['nom_categorie']);
        $image_categorie = htmlentities($_POST['image_categorie']);
        $description_categorie= htmlentities($_POST['description_categorie']);
        
 
        $bdd_categorie->updateCategorie($id_categorie,$nom_categorie, $image_categorie, $description_categorie);
        

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
    <div class="display-3 text-center">Modifier les catégories</div>

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
                        <input type="text" name="nom_categorie" class="form-control" placeholder="Entrer le nom..." value="<?php echo $user['nom_categorie']; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">Image</label>
                    <div class="col-sm-9">
                        <input type="text" name="image_categorie" class="form-control" placeholder="Insérer l'image..." value="<?php echo $user['image_categorie'];  ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="lastname" class="col-sm-3 control-label">Déscription</label>
                    <div class="col-sm-9">
                        <input type="text" name="description_categorie" class="form-control" placeholder="Entrer la description..." value="<?php echo $user['description_categorie'];  ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-md-12 mt-3">
                    <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                    <a href="index_categorie.php" class="btn btn-danger">Annuler</a>
                </div>
            </div>


    </form>

   
</body>
</html>