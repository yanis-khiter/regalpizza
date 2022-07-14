<?php 

session_start();

       require('./model/Produit.php');
       $bdd_categorie = new Produit();

    if (isset($_GET['update_id'])) {

            $id_produit = $_GET['update_id'];
            $user= $bdd_categorie->fetchUser($id_produit);

    }

    if (isset($_POST['btn_update'])) {

        $nom_produit = htmlentities($_POST['nom_produit']);
        $categorie_id = htmlentities($_POST['categorie_id']);
        $prix_produit= htmlentities($_POST['prix_produit']);
        $ingredient_produit = htmlentities($_POST['ingredient_produit']);
        $image_produit = htmlentities($_POST['image_produit']);
        $date_creation = htmlentities($_POST['date_creation']);
 
        $bdd_categorie->updateProduit($id_produit, $nom_produit, $categorie_id, $prix_produit, $ingredient_produit, $image_produit, $date_creation);
                
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
    <div class="display-3 text-center">Modifier les produits</div>

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
                        <input type="text" name="nom_produit" class="form-control" placeholder="Entrer le nom..." value="<?php echo $user['nom_produit']; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">Catégorie</label>
                    <div class="col-sm-9">
                        <input type="number" name="categorie_id" class="form-control" placeholder="Entrer la catégorie..." value="<?php echo $user['categorie_id'];  ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="lastname" class="col-sm-3 control-label">Prix</label>
                    <div class="col-sm-9">
                        <input type="number" name="prix_produit" class="form-control" placeholder="Entrer le nom..." value="<?php echo $user['prix_produit'];  ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="lastname" class="col-sm-3 control-label">Ingrédients</label>
                    <div class="col-sm-9">
                        <input type="text" name="ingredient_produit" class="form-control" placeholder="Entrer les ingrédients..." value="<?php echo $user['ingredient_produit'];  ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">Image</label>
                    <div class="col-sm-9">
                        <input type="text" name="image_produit" class="form-control" placeholder="Insérer l'image..." value="<?php echo $user['image_produit']; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">Date</label>
                    <div class="col-sm-9">
                        <input type="date" name="date_creation" class="form-control" placeholder="Entrer la date..." value="<?php echo $user['date_creation']; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-md-12 mt-3">
                    <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                    <a href="index_produits.php" class="btn btn-danger">Annuler</a>
                </div>
            </div>


    </form>

   
</body>
</html>