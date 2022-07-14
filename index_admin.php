<?php 

session_start();

        require('./model/Admin.php');
 
        $bdd_admin = new Admin();

    if (isset($_GET['delete_id'])) {
        $id_produit = $_GET['delete_id'];


        $bdd_admin->deleteAdmin($id_produit);


        header('Location:index_admin.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin</title>

    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>

    <div class="container">
    <div class="display-3 text-center">Index Admin</div>
    <a href="add.php" class="btn btn-success mb-3">Ajouter</a>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Prenom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>

        <tbody>
            <?php 
            
                $select_stmt = $bdd_admin->getAdmin();
            
                $row=$select_stmt;
                

                foreach($row as $rows) {

            ?>

                <tr>
                    <td><?php echo $rows["nom"]; ?></td>
                    <td><?php echo $rows["prenom"]; ?></td>
                    <td><?php echo $rows["email"]; ?></td>

                    <td><a href="edit.php?update_id=<?php echo $rows["id"]; ?>" class="btn btn-warning">Modifier</a></td>

                    
                    <td><a href="?delete_id=<?php echo $rows["id"]; ?>" class="btn btn-danger">Supprimer</a></td>
                </tr>

            <?php   } ?>

        </tbody>
    </table>
    </div>
    

</body>
</html>