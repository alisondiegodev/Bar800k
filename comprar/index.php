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
    <title>BAR 800K</title>
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>
    <div class="flex-rule">
        <main>
            <h1>BAR 800K</h1>
            <form method="POST" action="./entrar.php">
                <label for="login">Já tenho conta:</label>
                <input type="submit" name="login" class=submit2 value="Login">

            </form>
            <form method="POST" action="./cadastro.php">
                <label for="cadastro">Preciso criar uma:</label>

                <input type="submit" name="cadastro" value="Cadastrar">
            </form>
        </main>
        <section class="images">
            <img src="../assets/alien2.png" alt="Alien">



        </section>
    </div>


</body>

</html>