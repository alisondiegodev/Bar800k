<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {

    header('Location: login.php');
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

if (isset($usuario_id)) {
    $sql_select = "SELECT * FROM compras WHERE id_usuario = '$usuario_id' ORDER BY data DESC LIMIT 10";
    $result = $con->query($sql_select);
}

?>
<!-- HTML -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styleRead.css">
    <link rel="stylesheet" href="./global.css?cache=2">

    <style>

    </style>
</head>

<body>
    <div class="container">
        <div class="flex-rule">
            <main>
                <div class="header">
                    <p>Bem Vindo <?= $usuario_nome ?>!</p>
                    <div>
                        <a class="botao pad" href="logout.php"> Logout</a>
                    </div>
                </div>
                <div class="selecionar">

                    <form action="listar_mes.php" method="">
                        <label for="mes">Selecione o mês</label>
                        <input id="mes" value="" type="month" id="mes" name="mes">
                        <input type="submit" value="Ver Pedidos">

                    </form>
                </div>
                <table class="table caption-top" id=table>
                    <caption>ULTIMOS PEDIDOS</caption>
                    <thead>
                        <tr>
                            <th class="displaynone" scope="col">ID</th>
                            <th scope="col">Item</th>
                            <!-- <th scope="col">Preço</th> -->
                            <th scope="col">Data / Horário</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        while ($compras = mysqli_fetch_assoc($result)) {
                            $data = date('d-m', strtotime($compras['data']));
                            $hora = date('H:i', strtotime($compras['data']));
                            echo "<tr>";
                            echo "<td class='displaynone'>" . $compras['id_pedido'] . "</td>";
                            echo "<td>" . $compras['item_pedido'] . "</td>";
                            // echo "<td>" . "R$ " . $compras['valor_pedido'] . "</td>";
                            echo "<td>" . $data . " | " . $hora . "</td>";
                        }
                        ?>
                    </tbody>
                </table>


            </main>

        </div>
    </div>
    <script>
        month = new Date();
        monthString = month.toLocaleDateString("pt-br", {})
        monthArray = monthString.split("/");
        document.getElementById("mes").value = monthArray[2] + "-" + monthArray[1];
    </script>

</body>

</html>