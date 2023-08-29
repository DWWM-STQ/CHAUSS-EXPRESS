<?php
session_start();

// Vérification du rôle de l'utilisateur
if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    if ($role !== 'ADMIN') {
        header('Location: ../index.php');
        exit(); // Ajout de l'exit pour arrêter le script après la redirection
    }
} else {
    header('Location: ../index_admin.php');
    exit(); // Ajout de l'exit pour arrêter le script après la redirection
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" href="../css/style2.css">
  <title>Accueil Admin</title>
</head>

<body>
  <h1>Utilisateurs</h1>

  <a href="../admin/produits/index_produits.php" class="custom-button">Aller à Produits</a>
  <a href="../index.php" class="custom-button">Aller à l'Accueil</a>

  <div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <?php
                    require '../php/crud/config.php';
                    
                    if (!$link) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $sql = "SELECT * FROM users";

                    $result = mysqli_query($link, $sql);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table table-bordered table-striped">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th>Id</th>';
                            echo '<th>Login</th>';
                            echo '<th>Roles</th>';
                            echo '<th>Compte vérifié</th>';
                            echo '<th>Outils</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>' . $row['id'] . '</td>';
                                echo '<td>' . $row['login'] . '</td>';
                                echo '<td>' . $row['role'] . '</td>';
                                echo '<td>' . $row['isVerified'] . '</td>';
                                echo '<td>';
                                echo '<a href="../admin/update.php?id=' . $row['id'] . '" class="mr-3" title="update" data-toggle="tooltip"><span class="fas fa-pencil-alt custom-button"></span></a>';
                                echo '<a href="../admin/delete.php?id=' . $row['id'] . '" class="mr-3" title="delete" data-toggle="tooltip"><span class="fa fa-trash custom-button"></span></a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                            echo '</tbody>';
                            echo '</table>';
                        } else {
                            echo '<div class="alert alert-danger"><em>Aucun utilisateur trouvé.</em></div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger"><em>Erreur de requête : ' . mysqli_error($link) . '</em></div>';
                    }

                    mysqli_close($link);
                    ?>
        </div>
      </div>
    </div>
  </div>
</body>

</html>