<?php
session_start();
require_once './config.php';
if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {

  header('Location: entrar.php');
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


$sql = "SELECT * FROM produtos ORDER BY id_categoria";
$result = $con->query($sql);
?>
<!-- HTML -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema</title>
  <link rel="stylesheet" href="../css/styleRead.css">
  <link rel="stylesheet" href="../global.css?cache=8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>

<body>

  <div class="container">
    <div class="flex-rule usuario-div">
      <main>
        <div class="header">
          <p>Bem Vindo <?= $usuario_nome ?>!</p>
          <div>
            <a class="botao" href="./logout.php"> Logout</a>

          </div>
        </div>
        <div class="searchDiv">
          <input id="busca" placeholder="Nome Produto" type="search" />
          <button id="buscaBtn">Buscar</button>
        </div>
        <button class="botao2 mt-2" id="limpar"> Limpar Filtro </button>
        <div class="filtrar">
          <p>Filtro Categoria</p>
          <select id="categorias" name="categoria">
            <option value="0">Nenhum</option>
            <option value="1">Bebidas</option>
            <option value="2">Salgados</option>
            <option value="3">Doces</option>
          </select>

        </div>
        <table class="table caption-top" id=table>

          <caption>FAZER NOVA COMPRA</caption>

          <thead>
            <tr>
              <th style="display:none" scope="col"></th>
              <th scope="col">Item</th>
              <th scope="col">Preço</th>
              <th scope="col">Categoria</th>
              <th scope="col">Comprar</th>

            </tr>
          </thead>
          <tbody>
            <?php
            while ($produtos_lista = mysqli_fetch_assoc($result)) {
              echo "<tr class='trs' categoria='$produtos_lista[id_categoria]' produto='$produtos_lista[nome_produto]'>";
              echo "<td style='display:none'>" . $produtos_lista['id_produto'] . "</td>";
              echo "<td>" . $produtos_lista['nome_produto'] . "</td>";
              echo "<td>" . "R$ " . $produtos_lista['valor'] . "</td>";
              echo "<td>" . $produtos_lista['id_categoria'] . "</td>";
              echo "<td>
                    <button class= ' botaoCompra btn btn-primary' produto_id='$produtos_lista[id_produto]' nm='$produtos_lista[nome_produto]' valor='$produtos_lista[valor]' >
                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='#fff' class='bi bi-cart-check' viewBox='0 0 16 16'>
  <path d='M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z'/>
  <path d='M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z'/>
</svg>
                  </button>
                  
                  </td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
        <h6 id="searchNotFound">NENHUM ITEM CORRESPONDE A PESQUISA</h6>
        <div class="modal-cart" id="modal">
          <p>Confirme seu pedido</p>
          <table id="carrinho">
            <thead>
              <tr>
                <th class="pdr-65">Item</th>
                <th class="pdr-20">Valor</th>
                <th>Quantidade</th>
                <th></th>

              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

          <p>
            Deseja finalizar?
          </p>
          <div>
            <button id="confirmar">Confirmar</button>
            <button id="nao">Adicionar Outro</button>
          </div>
        </div>
      </main>
    </div>
  </div>

  <form action="add_compra.php" method="POST" id="form">
    <input id="form-input" type="hidden" name="carrinho" value="">
  </form>


  <script>
    const botaoCompra = document.querySelectorAll(".botaoCompra");
    let confirmar = document.getElementById("confirmar");
    let nao = document.getElementById('nao');
    let modal = document.getElementById('modal');
    let trs = document.querySelectorAll(".trs");
    let input = document.querySelector("#busca");
    let buscaBtn = document.querySelector("#buscaBtn");
    let limpar = document.querySelector("#limpar");
    let searchNotFound = document.getElementById("searchNotFound");
    var tbody = document.querySelector("#carrinho tbody");
    var html = "";
    let carrinho = [];
    let htmlArray
    var filtrar = document.querySelector("#categorias");



    filtrar.addEventListener("change", () => {

      if (filtrar.value == 1) {
        selected = "Bebidas";
      }
      if (filtrar.value == 2) {
        selected = "Salgados";
      }
      if (filtrar.value == 3) {
        selected = "Doces";
      }

      trs.forEach((item) => {
        if (item.attributes.categoria.value == selected) {
          item.style.display = "table-row";
        } else {
          item.style.display = "none";
        }
      })
      if (filtrar.value == 0) {
        trs.forEach((item) => {
          item.style.display = "table-row";
        })
      }
    })
    //CARRINHO
    botaoCompra.forEach(botoes);

    function botoes(btn) {
      btn.addEventListener("click", () => {
        let nomeProduto = btn.getAttribute('nm');
        let idProduto = btn.getAttribute('produto_id');
        let valorProduto = btn.getAttribute('valor');
        let table = document.querySelector("#carrinho");
        var tbody = document.querySelector("#carrinho tbody");



        let quantidade = "1";
        modal.style.display = 'flex';

        var item = {
          id: idProduto,
          nome: nomeProduto,
          valor: valorProduto,
          quantidade: quantidade,
        };

        carrinho.push(item);
        tbody.remove();
        var new_tbody = document.createElement("tbody");
        table.appendChild(new_tbody);
        var tbody = document.querySelector("#carrinho tbody");
        html = "";

        for (var i = 0; i < carrinho.length; i++) {
          html += "<tr>";
          html += `<td> ${carrinho[i].nome} </td>`;
          html += `<td> ${carrinho[i].valor} </td>`;
          html += `<td><button onclick="this.parentNode.querySelector('input').stepDown();atualizarQuantidade(${carrinho[i].id},this.parentNode.querySelector('input').value) "class='plus'>-</button> <input disabled type='number' value='${carrinho[i].quantidade}' min='1' max='5' onchange='atualizarQuantidade(${carrinho[i].id}, this.value)'><button onclick="this.parentNode.querySelector('input').stepUp();;atualizarQuantidade(${carrinho[i].id},this.parentNode.querySelector('input').value) "class='plus'>+</button></td>`;
          html += `<td> <button class='rm' onclick='removerItem(${carrinho[i].id}); this.parentNode.parentNode.remove()'>X</button></td>`;
          html += "</tr>";


        }
        tbody.innerHTML = html;

        nao.addEventListener('click', () => {
          modal.style.display = 'none';
        })

      })
    }

    function atualizarQuantidade(id, qtd) {
      for (var i = 0; i < carrinho.length; i++) {
        if (carrinho[i].id == id) {
          carrinho[i].quantidade = qtd;
          console.log(carrinho);
        }
      }
    }

    function removerItem(id) {
      carrinho = carrinho.filter(iterar => iterar.id != id);
      console.log(carrinho)

    }
    confirmar.addEventListener('click', () => {
      let form = document.querySelector("#form");
      let input_carrinho = document.querySelector("#form-input");
      input_carrinho.value = JSON.stringify(carrinho);
      form.submit()
    })

    //FUNCIONALIDADE SEARCH
    buscaBtn.addEventListener("click", () => {
      var pesquisa = input.value.toLowerCase();
      limpar.style.display = "block";
      var result = 0;
      trs.forEach((item) => {
        itemAtribute = item.getAttribute("produto");
        if (item.attributes.produto.value.toLowerCase().indexOf(pesquisa) > -1) {
          item.style.display = "table-row";
          result++;
          console.log(result);
        } else {
          item.style.display = "none";
        }

        if (result == 0) {
          searchNotFound.style.display = "block";
        } else {
          searchNotFound.style.display = "none";
        }
      })
    })

    limpar.addEventListener("click", () => {
      trs.forEach(item => item.style.display = "table-row");
      limpar.style.display = "none";
      searchNotFound.style.display = "none";

    })
    // FIM FUNCIONALIDADE SEARCH
  </script>





</body>

</html>