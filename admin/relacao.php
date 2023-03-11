<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['email_adm']) || !isset($_SESSION['senha_adm'])) {

    header('Location: login.php');
}
$sql = "SELECT * FROM usuarios ORDER BY id DESC";
$result = $con->query($sql);


$sqlCompras = "SELECT * FROM compras ORDER BY id_pedido DESC LIMIT 20";
$result_sql = $con->query($sqlCompras);


$mes = $_GET['mes'];
$mes_referencia = date('m', strtotime($mes));



$sqlmes = "SELECT `id_usuario`, `nome_usuario`, SUM(valor_pedido) AS total_gasto FROM compras WHERE MONTH(data) = $mes_referencia GROUP BY id_usuario";

$result_mes = $con->query($sqlmes);


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
    <link rel="stylesheet" href="../css/styleRead.css">
    <link rel="stylesheet" href="../global.css">
    <style>
        #table {
            background: unset;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="flex-rule">
            <main class="mt-2">
                <a class="logout botao mt-2 " href="logout_adm.php"> Logout</a>
                <br>
                <h1> SISTEMA BAR 800K
                </h1>
                <p>Area Administrativa</p>

                <div class="opcoes">
                    <a href="./admin.php"><button id="back">Home</button></a>
                    <button id="back">Imprimir</button>

                </div>



                <div class="flex-pai">
                    <table class="table caption-top " id=table>
                        <caption>USUARIOS</caption>
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Valor com desconto</th>
                                <th scope="col">Valor com multa</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($user_data = mysqli_fetch_assoc($result_mes)) {
                                $valor_inicial = $user_data['total_gasto'];
                                $porcentagem = 10;
                                $valor_desconto = $valor_inicial - ($valor_inicial * ($porcentagem / 100));
                                $valor_desconto = number_format($valor_desconto, 2, ',', '.');

                                $valor_multa = $valor_inicial + ($valor_inicial * ($porcentagem / 100));
                                $valor_multa = number_format($valor_multa, 2, ',', '.');



                                echo "<tr>";
                                echo "<td>" . $user_data['nome_usuario'] . "</td>";
                                echo "<td>" . "R$ " . $valor_desconto . "</td>";
                                echo "<td>" . "R$ " . $valor_multa . "</td>";
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </main>

        </div>
    </div>
    <script>
        let btn_usuarios = document.querySelector("#lista-usuarios");
        let btn_cad = document.querySelector("#cadastrar-produtos");
        let btn_ultimas = document.querySelector("#ultimas-compras")
        let ultimas_div = document.querySelector("#ultimas-div");
        let user_div = document.querySelector(".usuarios-div");
        let cad_div = document.querySelector(".cadastro-div");
        let relacao = document.querySelector("#relacao");


        btn_ultimas.addEventListener("click", () => {
            cad_div.style.display = "none"
            user_div.style.display = "none";
            ultimas_div.style.display = "block";
        })
        btn_usuarios.addEventListener("click", () => {
            user_div.style.display = "block";
            cad_div.style.display = "none"
            ultimas_div.style.display = "none";
        })
        btn_cad.addEventListener("click", () => {
            user_div.style.display = "none";
            cad_div.style.display = "flex"
            ultimas_div.style.display = "none";
        })


        document.getElementById('preco').addEventListener('keypress', function(evt) {
            if (evt.key == ',') {
                evt.preventDefault()
                alert('Não aceita virgula, apenas ponto!');
            }
        });
    </script>

</body>

</html>