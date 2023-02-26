<?php
session_start();

if (isset($_POST['email'])) {

    require_once './config.php';
    $email = $_POST['email'];
    $senha = $_POST['senha'];


    $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'";
    $result = $con->query($sql);


    if (mysqli_num_rows($result) < 1) {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: ./entrar.php');
    } else {

        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        header('Location: usuario.php');
    }
}
