<?php
session_start();
require_once './config.php';
if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {

    header('Location: entrar.php');
}


if (!empty($_SESSION['email'])) {

    $user_email = $_SESSION['email'];

    $sql = "SELECT * FROM usuarios WHERE email ='$user_email'";

    $sql_result = $con->query($sql);

    if ($sql_result->num_rows > 0) {
        $user = mysqli_fetch_assoc($sql_result);

        $usuario_id = $user['id'];
        $usuario_nome = $user['nome'];
    }
}


$sql = "SELECT * FROM produtos ORDER BY id_categoria";
$result = $con->query($sql);
?>
<!-- HTML -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <link rel="stylesheet" href="../css/styleRead.css">
    <link rel="stylesheet" href="../global.css?cache=7">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>

<body>
    <?php if (isset($_GET['ok'])) {
        echo "
    <p id='animacao'>Compra Realizada!</p>
    ";
    } ?>
    <div class="container">
        <main style="margin-top:80px" class="mainkey">
            <h1>Obrigado</h1>
            <p>Tenha um ótimo dia <?= $usuario_nome ?></p>

        </main>
</body>

<script>
    setTimeout(logout, 3000);

    function logout() {
        window.location.href = "./logout.php"
    }
</script>

</html>