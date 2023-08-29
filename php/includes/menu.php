<?php
session_start();

if (isset($_SESSION['login'])) {
    $connect = $_SESSION['login']; //ok
} else {
    $connect = 'KO';
}

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role']; //ok
} else {
    $role = '';
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-info" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand text-dark" href="./index.php">
                <img src="./logo.png" height="60">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="./index.php">Accueil</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-dark" href="./contact.php">Contact</a>
                    </li>

                    <!-- Partie Admin -->
                    <?php if ($role == 'ADMIN') : ?>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="./admin/index_admin.php">Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="./admin/produits/index_produits.php">Produits</a>
                        </li>
                    <?php endif; ?>


                    <?php if ($connect != 'ok') : ?>

                        <li class="nav-item">
                            <a class="nav-link text-dark" href="./login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="./inscription.php">Inscription</a>
                        </li>

                    <?php else : ?>

                        <li class="nav-item">
                            <a class="nav-link text-dark" href="./clients/crud/update_client.php">Mon Compte</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-dark" href="./deconnexion.php">Déconnexion</a>
                        </li>

                    <?php endif ?>



            </div>
    </nav>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
</body>

</html>