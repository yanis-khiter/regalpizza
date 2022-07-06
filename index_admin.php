<?php 
        require('./model/Admin.php');

        $bdd = new Bdd();
        $bdd_admin = new Admin();

    if (isset($_SESSION['delete_id'])) {
        $role_id = $_SESSION['delete_id'];

        $select_stmt = $this->bdd->prepare("SELECT * FROM admins");
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        // Delete an original record from db
        $delete_stmt = $this->bdd->prepare('DELETE FROM admins WHERE id = :id');
        $delete_stmt->bindParam(':id', $id);
        $delete_stmt->execute();

        header('Location:index_admin.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Index Admin</title>

    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>

    <div class="container">
    <div class="display-3 text-center">Information</div>
    <a href="add.php" class="btn btn-success mb-3">Ajouter</a>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Prenom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle ID </th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>

        <tbody>
            <?php 
            
                $select_stmt = $bdd_admin->getAdmin();
                $row=$select_stmt;
              
            ?>

                <tr>
                    <td><?php echo $row["nom"]; ?></td>
                    <td><?php echo $row["prenom"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["role_id"]; ?></td>
                    <td><a href="edit.php?update_id=<?php echo $row["id"]; ?>" class="btn btn-warning">Modifier</a></td>
                    <td><a href="?delete_id=<?php echo $row["id"]; ?>" class="btn btn-danger">Supprimer</a></td>
                </tr>

           
        </tbody>
    </table>
    </div>
    

</body>
</html>