<?php
if(!empty($_GET['id']))
{


require_once 'config.php';
$con = mysqli_connect('localhost', 'root' , '', 'cadastro');

$id = $_GET['id'];

$sqlSelect = "SELECT * FROM usuarios WHERE id=$id";

$result = $con->query($sqlSelect);

    if($result->num_rows > 0)
    {
        while($user_data = mysqli_fetch_assoc($result))
        {
        
        $nome = $user_data['nome'];
        $email = $user_data['email'];
        $senha = $user_data['senha'];
        }
    }
    else
    {
            header('Location: read.php');
    }
}
else
{
    header('Location: read.php');
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
        <link rel="stylesheet" href="css/styleCadastro.css">     
            <style>
                .voltar {
                display: flex;
                text-decoration:none;
                cursor: pointer;
                align-items: center;
                margin-top: 4rem;
                border: none;
                border-radius: 32px;
                background: #6c63ff;
                color: white;
                font-size: 1.1rem;
                transition: all .3s ease-in-out;
                width: 130px;
                height: fit-content;
                padding-left:29px;
                justify-items: auto;
                margin-top: 1rem;
                        }
                        .voltar:hover {
                background: #5952d4;
                    }
            </style>
    </head> 
    <body>
        <a class="voltar" href="read.php"> Voltar</a>   
<main>
    <h1>Editar Perfil</h1> 

     <!-- FORM -->
    <form method="POST" action="salvaredit.php">
        <label>
            <span>Name</span>
            <input type="text" name="nome" value="<?php echo $nome?>" >
        </label>
             <span>E-mail</span>
            <input type="email"  name="email" value="<?php echo $email?>" >
        </label>
            <span>Password</span>
            <input type="text"  name="senha" value="<?php echo $senha?>" >
        </label>
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="submit" name="update" id="update" value="Salvar">
    </form>
    
</main>
<!-- ALIEN -->
<section class="images">
<img src="assets/alien2.png" alt="Alien">   
</section>

</body>
</html>