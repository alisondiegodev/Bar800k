<<<<<<< HEAD
<?php

    if(!empty($_GET['id']))
    {
        require_once('config.php');
        $con = mysqli_connect('localhost', 'root' , '', 'cadastro');
        $id = $_GET['id'];

        $sqlSelect = "SELECT *  FROM usuarios WHERE id=$id";

        $result = $con->query($sqlSelect);

        if($result->num_rows > 0)
        {
            $sqlDelete = "DELETE FROM usuarios WHERE id=$id";
            $resultDelete = $con->query($sqlDelete);
        }
    }
    header('Location: read.php');
   
=======
<?php

    if(!empty($_GET['id']))
    {
        require_once('config.php');
        $con = mysqli_connect('localhost', 'root' , '', 'cadastro');
        $id = $_GET['id'];

        $sqlSelect = "SELECT *  FROM usuarios WHERE id=$id";

        $result = $con->query($sqlSelect);

        if($result->num_rows > 0)
        {
            $sqlDelete = "DELETE FROM usuarios WHERE id=$id";
            $resultDelete = $con->query($sqlDelete);
        }
    }
    header('Location: read.php');
   
>>>>>>> 6eb96d8238cdd5fe1e009a6430d7fa0ada500c8d
?>