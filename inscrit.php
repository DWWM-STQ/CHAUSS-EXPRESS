<?php

require './php/crud/protection.php';

if(isset($_POST['pseudo'])){
    $pseudo = $_POST['pseudo'];
}else{
    $_SESSION['erreur'].='Champ Incorrect';
    header('location: ./inscription.php');
    exit();
}

if(isset($_POST['password'])){
    $password = $_POST['password'];
}else{
    $_SESSION['erreur'].='Champ Incorrect';
    header('location: ./inscription.php');
    exit();
}

require_once './php/crud/config.php';

$login = protect_montexte($pseudo);
$password = protect_montexte($password);

$pass = password_hash($password,PASSWORD_DEFAULT);

$sql = "INSERT INTO users (login, mdp, role, isVerified) values (?,?,?,?)";

if($stmt = mysqli_prepare($link,$sql)){
    mysqli_stmt_bind_param($stmt, "sssi", $param_login, $param_mdp, $param_role, $param_verif);
    $param_login = $login;
    $param_mdp = $pass;
    $param_role = "USER";
    $param_verif = false;

    if (mysqli_stmt_execute($stmt)){
        header('location: ./index.php');
        exit();
    }

}
?>