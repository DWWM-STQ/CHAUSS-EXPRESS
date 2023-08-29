<?php
session_start();

// Inclure les informations de connexion à la base de données
require_once "./php/crud/config.php";

if (!$link) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

function redirectWithError($message) {
    $_SESSION['erreur'] = $message;
    header('Location: ./login.php');
    exit();
}

if (isset($_POST['login'], $_POST['password'], $_POST['user_id'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $user_id = $_POST['user_id']; // Récupérez l'ID de l'utilisateur du champ caché

    require_once "./php/crud/protection.php";

    $login_ok = protect_montexte($login);
    $password_ok = protect_montexte($password);

    $sql = "SELECT * FROM users WHERE login = ?";
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $login_ok);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($password_ok, $row['mdp'])) {
                    $_SESSION['user_id'] = $user_id; // Stockez l'ID de l'utilisateur dans la session
                    $_SESSION['login'] = 'ok';
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['client'] = $row['login'];
                    header('Location: ./index.php');
                    exit();
                }
            }
            redirectWithError("Mot de passe incorrect !");
        } else {
            redirectWithError("Login incorrect !");
        }

        mysqli_stmt_close($stmt);
    } else {
        redirectWithError("Erreur de requête !");
    }
}

// Si les informations ne sont pas valides, afficher une erreur
redirectWithError("Veuillez remplir tous les champs !");
?>
