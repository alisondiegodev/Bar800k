<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['email_adm']) || !isset($_SESSION['senha_adm'])) {

  header('Location: login.php');
}
$sql = "SELECT * FROM usuarios ORDER BY id DESC";
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
  <link rel="stylesheet" href="css/styleRead.css">
  <link rel="stylesheet" href="./global.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>


<style>
  .flex-rule {
    display: flex;
    justify-content: space-between;
    width: 100%;
  }

  body {
    color: #fff !important;
  }
</style>

<body>
  <div class="container">
    <div class="flex-rule">
      <main>
        <a class="logout" href="logout_adm.php"> Logout</a>
        <h1> BEM VINDO
        </h1>
        <p>Area Administrativa</p>
        <div class="flex-pai">
          <table class="table caption-top" id=table>
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
          <form method="POST" action="salvar_produto.php">
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





        </div>



      </main>

    </div>
  </div>
  <script>
    document.getElementById('preco').addEventListener('keypress', function(evt) {
      if (evt.key == ',') {
        evt.preventDefault()
        alert('Não aceita virgula, apenas ponto!');
      }
    });
  </script>

</body>

</html>