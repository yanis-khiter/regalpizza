<?php

session_start();

require('./model/Produit.php');
require_once ('./model/Outils.php');

$bdd_produit = new Produit();

if (isset($_POST['btn_insert'])) {

    $nom_produit = $_POST['nom_produit'];
    $categorie_id = $_POST['categorie_id'];
    $prix_produit = $_POST['prix_produit'];
    $ingredient_produit = $_POST['ingredient_produit'];
    $image_produit = '/public/img/';
    $date_creation = $_POST['date_creation'];


                        if (empty($nom_produit)) {

                            $errorMsg = "Entrez votre nom s'il vous plait";
                        } else if (empty($categorie_id)) {
                            $errorMsg = "Entrez votre catégorie s'il vous plait";
                        } else if (empty($prix_produit)) {
                            $errorMsg = "Entrez votre prix s'il vous plait";
                        } else if (empty($ingredient_produit)) {
                            $errorMsg = "Entrez vos ingrédients s'il vous plait";
                        } else if (empty($image_produit)) {
                            $errorMsg = "Entrez votre image s'il vous plait";
                        } else if (empty($date_creation)) {
                            $errorMsg = "Entrez date de création s'il vous plait";
                        } else {

   
                        $nameFile = (Outils::checkImage());

                                if ($nameFile) {

                                    $bdd_produit->createProduit($nom_produit, $categorie_id, $prix_produit,  $ingredient_produit, 'public/img/' .$nameFile, $date_creation);

                                    $insertMsg = "Insertion réussie ! Vous allez être redirigé";

                                    header("refresh:1;index_produits.php");
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
                <strong>Réussie ! <?= $insertMsg; ?></strong>
            </div>
        <?php } ?>

        <form method="post" action="add_produits.php" class="form-horizontal mt-5" enctype="multipart/form-data">

            <div class="form-group text-center">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">Nom</label>
                    <div class="col-sm-9">
                        <input type="text" name="nom_produit" class="form-control" placeholder="Entrer le nom...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">Catégorie</label>
                    <div class="col-sm-9">
                        <input type="number" name="categorie_id" class="form-control" placeholder="Entrer la catégorie...">
                        <!-- <select name="categories" id="catselect">
                            <option value=""
                        </select> -->
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">Prix</label>
                    <div class="col-sm-9">
                        <input type="number" name="prix_produit" class="form-control" placeholder="Entrer le prix...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">Ingrédients</label>
                    <div class="col-sm-9">
                        <input type="text" name="ingredient_produit" class="form-control" placeholder="Entrer les ingrédients...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">Image</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" name="avatar" id="" placeholder="Entrer l'image...">

                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="firstname" class="col-sm-3 control-label">Date de création</label>
                    <div class="col-sm-9">
                        <input type="date" name="date_creation" class="form-control" placeholder="Entrer la date...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-md-12 mt-3">

                    <input type="submit" name="btn_insert" class="btn btn-success" value="Insérer">
                    <a href="index_produits.php" class="btn btn-danger">Annuler</a>
                </div>
            </div>


        </form>


</body>

</html>