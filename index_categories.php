<?php 

session_start();

        require('./model/Categorie.php');

        $bdd_categorie = new Categorie();

    if (isset($_GET['delete_id'])) {
        $id_categorie = $_GET['delete_id'];


        $bdd_categorie->deleteCategorie($id_categorie);


        header('Location:index_categories.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Index Categorie</title>

    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>

    <div class="container">
    <div class="display-3 text-center">Catégorie</div>
    <a href="add_categories.php" class="btn btn-success mb-3">Ajouter</a>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Image</th>
                <th>Description</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>

        <tbody>
            <?php 
                       $select_stmt = $bdd_categorie->getCategorie();
            
                       $row=$select_stmt;
       
                       foreach($row as $rows) {
              
            ?>

                <tr>
                    <td><?php echo $rows["nom_categorie"]; ?></td>
                    <td><img style="width : 150px" src="<?php echo $rows["image_categorie"]; ?>" alt="Categorie Classique"></td>
                    <td><?php echo $rows["description_categorie"]; ?></td>
                    
                    <td><a href="edit_categories.php?update_id=<?php echo $rows["id_categorie"]; ?>" class="btn btn-warning">Modifier</a></td>
                    <td><a href="?delete_id=<?php echo $rows["id_categorie"]; ?>" class="btn btn-danger">Supprimer</a></td>
                </tr>

                <?php   } ?>

        </tbody>
    </table>
    </div>
    

</body>
</html>