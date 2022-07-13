<?php 
    require('./model/Categorie.php');

    $bdd_categories = new Categorie();

    if (isset($_POST['btn_insert'])) {

        $nom_category = $_POST['nom_categorie'];
        $image_category = $_POST['image_categorie'];
        $description_category = $_POST['description_categorie'];
  


        if (empty($nom_categorie)) {
            $errorMsg = "Entrez votre nom s'il vous plait";
        } else if (empty($image_categorie)) {
            $errorMsg = "Entrez votre image s'il vous plait";
        }else if (empty($description_categorie)) {
            $errorMsg = "Entrez votre catégorie s'il vous plait";
        } else {
  
            try {
      
                if (!isset($errorMsg)) {
                    
                    $bdd_categories->createCategorie($nom_categorie, $image_categorie, $description_categorie);

                    $insertMsg = "Insertion réussie ! Vous allez être redirigé";

                    header("refresh:1;index_categorie.php");

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

    <form method="post" class="form-horizontal mt-5" enctype="multipart/form-data">
            
            <div class="form-group text-center">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">Nom</label>
                    <div class="col-sm-9">
                        <input type="text" name="nom_categorie" class="form-control" placeholder="Entrer le nom...">
                    </div>
                </div>
            </div> 
            <div class="form-group text-center">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">Image</label>
                    <div class="col-sm-9">
                        <input type="file" name="image_categorie" class="form-control" placeholder="Entrer l'image...">
                    </div>
                </div>
            </div> 
            <div class="form-group text-center">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                        <input type="texte" name="description_categorie" class="form-control" placeholder="Entrer la date...">
                    </div>
                </div>
            </div>  
            <div class="form-group text-center">
                <div class="col-md-12 mt-3">
                    
                    <input type="submit" name="btn_insert" class="btn btn-success" value="Insérer">
                    <a href="index_categorie.php" class="btn btn-danger">Annuler</a>
                </div>
            </div>


    </form>


</body>
</html>