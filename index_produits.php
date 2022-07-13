<?php 
        require('./model/Produit.php');


        $bdd_produit = new Produit();

    if (isset($_GET['delete_id'])) {
        $id_produit = $_GET['delete_id'];

        // $select_stmt = $bdd->prepare("SELECT * FROM produits");
        // $select_stmt->bindParam(':id_produit', $id_produit);
        // $select_stmt->execute();
        // $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        $bdd_produit->deleteProduit($id_produit);

        // Delete an original record from db


        header('Location:index_produits.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Index Produit</title>

    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>

    <div class="container">
    <div class="display-3 text-center">Produit</div>
    <a href="add_produits.php" class="btn btn-success mb-3">Ajouter</a>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Categorie</th>
                <th>Prix</th>
                <th>Ingrédients </th>
                <th>Image </th>
                <th>Date </th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>

        <tbody>
            <?php 
          $select_stmt = $bdd_produit->getProduit();
            
          $row=$select_stmt;

          foreach($row as $rows) {

              
            ?>

                <tr>
                    <td><?php echo $rows["nom_produit"]; ?></td>
                    <td><?php echo $rows["categorie_id"]; ?></td>
                    <td><?php echo $rows["prix_produit"]; ?></td>
                    <td><?php echo $rows["ingredient_produit"]; ?></td>
                    <td><img style="width : 150px" src="<?php echo $rows["image_produit"]; ?>" alt="pizza fromage"></td>
                    <td><?php echo $rows["date_creation"]; ?></td>

                    <td><a href="edit_produits.php?update_id=<?php echo $rows["id_produit"]; ?>" class="btn btn-warning">Modifier</a></td>

                    <td><a href="?delete_id=<?php echo $rows["id_produit"]; ?>" class="btn btn-danger">Supprimer</a></td>
                </tr>

                <?php   } ?>
           
        </tbody>
    </table>
    </div>
    

</body>
</html>