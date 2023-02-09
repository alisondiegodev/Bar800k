<<<<<<< HEAD
<?php
//#TESTE
//print_r($_REQUEST);
session_start();

if (isset($_POST['email'])) {
  //Acessa
  require_once 'config.php';
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  //#TESTE
  //print_r('Email: ' . $email);
  //print_r('<br>');
  //print_r('Senha: ' . $senha);

  require_once 'config.php';
  $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'";
  $result = $con->query($sql);
  //#TESTE
  // print_r($sql);
  //print_r($result);


  //NÃO LOGOU
  if (mysqli_num_rows($result) < 1) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
  }
  //LOGOU
  else {

    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    header('Location: usuario.php');
  }
}
=======
<?php
//#TESTE
//print_r($_REQUEST);
session_start();

if (isset($_POST['email'])) {
  //Acessa
  require_once 'config.php';
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  //#TESTE
  //print_r('Email: ' . $email);
  //print_r('<br>');
  //print_r('Senha: ' . $senha);

  require_once 'config.php';
  $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'";
  $result = $con->query($sql);
  //#TESTE
  // print_r($sql);
  //print_r($result);


  //NÃO LOGOU
  if (mysqli_num_rows($result) < 1) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
  }
  //LOGOU
  else {

    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    header('Location: usuario.php');
  }
}
>>>>>>> 6eb96d8238cdd5fe1e009a6430d7fa0ada500c8d
