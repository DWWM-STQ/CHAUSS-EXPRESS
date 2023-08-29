<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'ADMIN') {
  header('Location: ../index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" href="../../css/style2.css">
  <link rel="stylesheet" href="../../css/pagination_style.css">
  <title>Accueil Produits</title>
</head>

<body>

  <h1>Produits</h1>

  <div class="col-md-12">
    <a class="btn btn-secondary" href="./crud/create_produit.php" role="button">Ajouter un produit +</a>
  </div>

  <a href="../../admin/index_admin.php" class="custom-button">Aller à Admin</a>
  <a href="../../index.php" class="custom-button">Aller à l'Accueil</a>

  <div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <?php
          require '../../php/crud/config.php';

          if (!$link) {
            die("Connection failed: " . mysqli_connect_error());
          }

          // Ajoutez ces lignes pour la pagination
          $itemsPerPage = 6;
          $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
          $startFrom = ($currentPage - 1) * $itemsPerPage;

          $sql = "SELECT * FROM products LIMIT $startFrom, $itemsPerPage";
          $result = mysqli_query($link, $sql);

          if ($result) {
            if (mysqli_num_rows($result) > 0) {
              echo '<table class="table table-bordered table-striped">';
              echo '<thead>';
              echo '<tr>';
              echo '<th>id</th>';
              echo '<th>category</th>';
              echo '<th>image</th>';
              echo '<th>brand</th>';
              echo '<th>type</th>';
              echo '<th>name</th>';
              echo '<th>color</th>';
              echo '<th>price</th>';
              echo '<th>ref</th>';
              echo '<th>description</th>';
              echo '</tr>';
              echo '</thead>';
              echo '<tbody>';

              while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['category'] . '</td>';
                echo '<td><img src="../../images_produits/' . $row['img'] . '" class="product-image" width="100" height="100"></td>';
                echo '<td>' . $row['brand'] . '</td>';
                echo '<td>' . $row['type'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['color'] . '</td>';
                echo '<td>' . $row['price'] . '</td>';
                echo '<td>' . $row['ref'] . '</td>';
                echo '<td>' . $row['description'] . '</td>';
                echo '<td>';
                echo '<a href="./crud/update_produit.php?id=' . $row['id'] . '" class="mr-3" title="Update" data-toggle="tooltip"><span class="fas fa-pencil-alt"></span></a>';
                echo '<a href="./crud/delete_produit.php?id=' . $row['id'] . '" class="mr-3" title="Delete" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                echo '</td>';
                echo '</tr>';
              }
              echo '</tbody>';
              echo '</table>';
            } else {
              echo '<div class="alert alert-danger"><em>Aucun produit trouvé.</em></div>';
            }
          } else {
            echo '<div class="alert alert-danger"><em>Erreur lors de la requête : ' . mysqli_error($link) . '</em></div>';
          }
          // Calcul du nombre total de pages
          $totalItemsQuery = "SELECT COUNT(*) as total FROM products";
          $totalItemsResult = mysqli_query($link, $totalItemsQuery);
          $totalItems = mysqli_fetch_assoc($totalItemsResult)['total'];
          $totalPages = ceil($totalItems / $itemsPerPage);

          // Affichage des liens de pagination
          echo '<div class="pagination">';
          if ($currentPage > 1) {
            echo '<a href="?page=' . ($currentPage - 1) . '">Précédent</a>';
          }
          for ($i = 1; $i <= $totalPages; $i++) {
            $activeClass = ($i === $currentPage) ? 'active' : '';
            echo '<a class="' . $activeClass . '" href="?page=' . $i . '">' . $i . '</a>';
          }
          if ($currentPage < $totalPages) {
            echo '<a href="?page=' . ($currentPage + 1) . '">Suivant</a>';
          }
          echo '</div>';

          mysqli_close($link);
          ?>
        </div>
      </div>
    </div>
  </div>
</body>

</html>