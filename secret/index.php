<?php
?>
<!-- HTML -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../css/styleLogin.css">
</head>

<body>
    <div class="flex-rule">
        <main class="mainkey">
            <h1>LIBERAR COMPRA</h1>
            <form action="loginadmin.php" method="POST">
                <label>
                    <span>E-mail Admin</span>
                    <input type="email" name="email_adm">
                </label>
                <label>
                    <span>Password Admin</span>
                    <input type="password" name="senha_adm">
                </label>
                <input type="submit" value="Login">
            </form>

        </main>
        <section class="images">
            <img src="../assets/alien2.png" alt="Alien">
        </section>
    </div>

</body>

</html>