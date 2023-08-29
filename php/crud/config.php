<?php
//config de la BDD //

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME','chaussures');

// lancer la connexion a la BDD //

$link = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

// gestion des erreurs de connexion //

if($link === false){
    die("ERROR : connexion impossible". mysqli_connect_error());
}

?>
