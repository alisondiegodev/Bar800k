<?php

require_once 'config.php';
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];


$result = "INSERT INTO usuarios (nome, email, senha) VALUES (
'$nome', '$email', '$senha')";
if (mysqli_query($con, $result)) { ?>
    <p class="alert-success">
    <div id="adicionar" class="animacao"> <?= $nome; ?>, <?= $email; ?> Adicionado com sucesso!</div>
    </p>
<?php } else { ?>
    <p class="alert-success">Não funcionou <?= $nome; ?> não foi adicionado!</p>


<?php }
header('Location: login.php');
?>