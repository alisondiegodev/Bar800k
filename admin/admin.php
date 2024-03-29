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
          <button id="lista-usuarios">Usuários</button>
          <button id="cadastrar-produtos">Cadastrar Produtos</button>
          <button id="ultimas-compras">Ultimas Compras</button>
          <button id="relacao">Relação Mensal</button>
          <button id="emails">Enviar E-Mails</button>
        </div>
        <div class="flex-pai">
          <table class="table caption-top usuarios-div" id=table>
            <caption>USUARIOS</caption>
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Senha</th>
                <th scope="col">Edit/Delete</th>

              </tr>
            </thead>
            <tbody>
              <?php
              while ($user_data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $user_data['id'] . "</td>";
                echo "<td>" . $user_data['nome'] . "</td>";
                echo "<td>" . $user_data['email'] . "</td>";
                echo "<td>" . $user_data['senha'] . "</td>";
                echo "<td>
                    <a class= 'btn btn-primary' href='./edit.php?id=$user_data[id]'>
                    <svg xmlns='<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
  <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
</svg>
                  </a>
                
                
                  </td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>

          <!-- CADASTRAR -->
          <form class="cadastro-div" method="POST" action="salvar_produto.php">
            <h1 class="cad-h1">Cadastrar Novo Produto</h1>
            <label>
              <span>Nome Produto</span>
              <input type="text" name="nome_produto">
            </label>
            <br>
            <span>Valor</span>
            <input id="preco" type="number" min="0.00" max="10000.00" step="0.01" name="valor">
            <br>
            <span>Categoria</span>

            <select id="categorias" name="categoria">
              <option value="1">Bebidas</option>
              <option value="2">Salgados</option>
              <option value="3">Doces</option>
            </select> <input type="submit" name="submit" value="Cadastrar">
          </form>

          <!-- ULTIMAS COMPRAS -->
          <table class="table caption-top ultimas-div" id=ultimas-div>
            <caption>ULTIMAS COMPRAS</caption>
            <thead>
              <tr>
                <th scope="col">Item</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Nome</th>
                <th scope="col">Horário</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($ultimas_compras = mysqli_fetch_assoc($result_sql)) {
                $data = date('d-m', strtotime($ultimas_compras['data']));
                $hora = date('H:i', strtotime($ultimas_compras['data']));
                echo "<tr>";
                echo "<td>" . $ultimas_compras['item_pedido'] . "</td>";
                echo "<td>" . $ultimas_compras['quantidade'] . "</td>";
                echo "<td>" . $ultimas_compras['nome_usuario'] . "</td>";
                echo "<td>" . $data . " - " . $hora . "</td>";
              }
              ?>
            </tbody>
          </table>


          <div id="relacao-div" class="selecionar relacao-div">

            <form action="relacao.php" method="GET">
              <label for="mes">Selecione o mês</label>
              <input type="month" id="mes" name="mes">
              <input type="submit" value="Visualizar">

            </form>
          </div>

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
    let relacao_div = document.querySelector("#relacao-div");



    relacao.addEventListener("click", () => {
      relacao_div.style.display = "block";
      cad_div.style.display = "none"
      user_div.style.display = "none";
      ultimas_div.style.display = "none";
    })
    btn_ultimas.addEventListener("click", () => {
      cad_div.style.display = "none"
      user_div.style.display = "none";
      ultimas_div.style.display = "block";
      relacao_div.style.display = "none";

    })
    btn_usuarios.addEventListener("click", () => {
      user_div.style.display = "block";
      cad_div.style.display = "none"
      ultimas_div.style.display = "none";
      relacao_div.style.display = "none";

    })
    btn_cad.addEventListener("click", () => {
      user_div.style.display = "none";
      cad_div.style.display = "flex"
      ultimas_div.style.display = "none";
      relacao_div.style.display = "none";

    })


    document.getElementById('preco').addEventListener('keypress', function(evt) {
      if (evt.key == ',') {
        evt.preventDefault()
        alert('Não aceita virgula, apenas ponto!');
      }
    });

    month = new Date();
    monthString = month.toLocaleDateString("pt-br", {})
    monthArray = monthString.split("/");
    mes = parseInt(monthArray[1]);
    mes = mes - 1;
    mes = "0" + mes.toString();
    document.getElementById("mes").value = monthArray[2] + "-" + mes;
  </script>

</body>

</html>