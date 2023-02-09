<<<<<<< HEAD
<?php
require_once 'config.php';
$nome_produto = $_POST['nome_produto'];
$valor = $_POST['valor'];
$categoria = $_POST['categoria'];

if ($categoria == "1") {
    $categoria = "Bebidas";
} elseif ($categoria == "2") {
    $categoria = "Salgados";
} elseif ($categoria == "3") {
    $categoria = "Doces";
};



$result = "INSERT INTO produtos (nome_produto,valor,id_categoria) VALUES (
    '$nome_produto', '$valor', '$categoria')";
if (mysqli_query($con, $result)) { ?>
    <p class="alert-success">
    <div id="adicionar" class="animacao"></div>

    <?= $nome_produto; ?> Adicionado com sucesso!

    </p>
<?php } else { ?>
    <p class="alert-success">Não funcionou <?= $nome_produto; ?> não foi adicionado!</p>


<?php }

?>
<!DOCTYPE html>
<html lang="pt-br">
<style>
    #return {
        font-size: 40px;
        color: #fff;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/styleLogin.css">
</head>

<body>
    <a id="return" href="./admin.php">Voltar</a>

</body>

=======
<?php
require_once 'config.php';
$nome_produto = $_POST['nome_produto'];
$valor = $_POST['valor'];
$categoria = $_POST['categoria'];

if ($categoria == "1") {
    $categoria = "Bebidas";
} elseif ($categoria == "2") {
    $categoria = "Salgados";
} elseif ($categoria == "3") {
    $categoria = "Doces";
};



$result = "INSERT INTO produtos (nome_produto,valor,id_categoria) VALUES (
    '$nome_produto', '$valor', '$categoria')";
if (mysqli_query($con, $result)) { ?>
    <p class="alert-success">
    <div id="adicionar" class="animacao"></div>

    <?= $nome_produto; ?> Adicionado com sucesso!

    </p>
<?php } else { ?>
    <p class="alert-success">Não funcionou <?= $nome_produto; ?> não foi adicionado!</p>


<?php }

?>
<!DOCTYPE html>
<html lang="pt-br">
<style>
    #return {
        font-size: 40px;
        color: #fff;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/styleLogin.css">
</head>

<body>
    <a id="return" href="./admin.php">Voltar</a>

</body>

>>>>>>> 6eb96d8238cdd5fe1e009a6430d7fa0ada500c8d
</html>