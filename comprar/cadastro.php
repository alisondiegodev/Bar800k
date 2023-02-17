<?php

if (!isset($_COOKIE['oi']) == true) {
    header('Location: error.php');
}


?>
<!-- HTML -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../css/styleCadastro.css">
</head>

<body>
    <div class="flex-rule">

        <main>
            <h1>Criar Conta</h1>
            <!-- FORM -->
            <form method="POST" action="salvar.php">
                <label>
                    <span>Nome Completo</span>
                    <input type="text" name="nome">
                </label>
                <span>E-mail</span>
                <input type="email" name="email">
                </label>
                <span>Senha</span>
                <input minlength="6" type="password" name="senha">
                </label>
                <input type="submit" name="submit" value="Cadastrar">
            </form>

        </main>
        <!-- ALIEN -->
        <section class="images">
            <img src="../assets/alien2.png" alt="Alien">
        </section>
    </div>
</body>

</html>