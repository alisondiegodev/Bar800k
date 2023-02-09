<<<<<<< HEAD
<?php
require_once 'config.php';


if (isset($_POST['update'])) {
    $id =   $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];


    $sqlUpdate = "UPDATE usuarios SET nome='$nome', email='$email', senha='$senha' WHERE id = '$id'";

    $result = $con->query($sqlUpdate);
}
header('Location: admin.php');
=======
<?php
require_once 'config.php';


if (isset($_POST['update'])) {
    $id =   $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];


    $sqlUpdate = "UPDATE usuarios SET nome='$nome', email='$email', senha='$senha' WHERE id = '$id'";

    $result = $con->query($sqlUpdate);
}
header('Location: admin.php');
>>>>>>> 6eb96d8238cdd5fe1e009a6430d7fa0ada500c8d
