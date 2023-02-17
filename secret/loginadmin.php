<?php
//#TESTE
//print_r($_REQUEST);
session_start();

if (isset($_POST['email_adm'])) {
    //Acessa
    require_once '../config.php';
    $email = $_POST['email_adm'];
    $senha = $_POST['senha_adm'];
    //#TESTE
    //print_r('Email: ' . $email);
    //print_r('<br>');
    //print_r('Senha: ' . $senha);

    $sql = "SELECT * FROM admins WHERE email_adm = '$email' and senha_adm = '$senha'";
    $result = $con->query($sql);
    //#TESTE
    // print_r($sql);
    //print_r($result);


    //NÃO LOGOU
    if (mysqli_num_rows($result) < 1) {
        unset($_SESSION['email_adm']);
        unset($_SESSION['senha_adm']);
        header('Location: ./index.php');
    }
    //LOGOU
    else {
        setcookie("oi", 'oi', (time() + (365 * 24 * 3600)), "/");
        $_SESSION['email_adm'] = $email;
        $_SESSION['senha_adm'] = $senha;
        header('Location: ../comprar/index.php');
    }
}
