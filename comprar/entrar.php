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
    <link rel="stylesheet" href="../css/styleLogin.css">
    <link rel="stylesheet" href="../global.css">


</head>

<body>
    <div class="flex-rule">
        <main class="mainkey">
            <h1>Login</h1>



            <form action="entrar_test.php" method="POST">
                <label>
                    <span>E-mail</span>
                    <input type="email" name="email">
                </label>
                <label>
                    <span>Password</span>
                    <input type="password" name="senha">
                </label>
                <input type="submit" value="Login">
            </form>
            <p class="mt-2">Ainda não tem conta? <a class="link" href="./cadastro.php">Cadastre-se.</a></p>

        </main>
        <section class="images">
            <img src="../assets/alien2.png" alt="Alien">
        </section>
    </div>

</body>

</html>