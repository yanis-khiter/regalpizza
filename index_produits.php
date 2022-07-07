<?php 
        require('./model/Produit.php');

        $bdd = new Bdd();
        $bdd_produit = new Produit();

    if (isset($_SESSION['delete_id'])) {
        $id_produit = $_SESSION['delete_id'];

        $select_stmt = $this->bdd->prepare("SELECT * FROM produits");
        $select_stmt->bindParam(':id_produit', $id_produit);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        // Delete an original record from db
        $delete_stmt = $this->bdd->prepare('DELETE FROM produits WHERE id_produit = :id_produit');
        $delete_stmt->bindParam(':id_produit', $id_produit);
        $delete_stmt->execute();

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
    <div class="display-3 text-center">Index Produit</div>
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
              
            ?>

                <tr>
                    <td><?php echo $row["nom_produit"]; ?></td>
                    <td><?php echo $row["categorie_id"]; ?></td>
                    <td><?php echo $row["prix_produit"]; ?></td>
                    <td><?php echo $row["ingredient_produit"]; ?></td>
                    <td><img style="width : 150px" src="<?php echo $row["image_produit"]; ?>" alt="pizza fromage"></td>
                    <td><?php echo $row["date_creation"]; ?></td>
                    <td><a href="edit_produits.php?update_id=<?php echo $row["id_produit"]; ?>" class="btn btn-warning">Modifier</a></td>
                    <td><a href="?delete_id=<?php echo $row["id_produit"]; ?>" class="btn btn-danger">Supprimer</a></td>
                </tr>

           
        </tbody>
    </table>
    </div>
    

</body>
</html>