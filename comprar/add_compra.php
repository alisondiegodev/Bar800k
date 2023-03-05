<?php
session_start();
include_once 'config.php';

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


if (isset($_POST['carrinho'])) {
    $carrinho = json_decode($_POST['carrinho'], true);



    foreach ($carrinho as $item) {


        $qtd = $item['quantidade'];
        $valor = $item['valor'];
        $valor_final = $qtd * $valor;



        $sqlCompra = "INSERT INTO compras (item_pedido, quantidade, valor_pedido, id_usuario, nome_usuario) VALUES ('$item[nome]','$item[quantidade]','$valor_final','$usuario_id','$usuario_nome')";

        $compraResult = $con->query($sqlCompra);
    }
}

// if (!empty($_GET['id'])) {

//     $id = $_GET['id'];

//     $query = "SELECT * FROM produtos WHERE id_produto = $id";

//     $result = $con->query($query);

//     if ($result->num_rows > 0) {
//         $produto_info = mysqli_fetch_assoc($result);

//         $nome_produto = $produto_info['nome_produto'];
//         $valor = $produto_info['valor'];
//     }
// }

// if (!empty($_SESSION['email'] && !empty($_GET['id']))) {
//     $sqlCompra = "INSERT INTO compras (item_pedido,valor_pedido,id_usuario,nome_usuario) VALUES ('$nome_produto', '$valor', '$usuario_id', '$usuario_nome')";
//     $compraResult = $con->query($sqlCompra);
// }



// header('Location: usuario.php?ok=true');