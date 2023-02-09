<<<<<<< HEAD
<?php
//$dbhost = 'localhost';
//$dbusuario = 'root';
//$dbsenha = '';
//$dbname = 'cadastro';


$con = mysqli_connect('localhost', 'root', '', 'bar');
//$db = mysqli_select_db($con, 'cadastro');
if (mysqli_connect_error()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   exit();
}
=======
<?php
//$dbhost = 'localhost';
//$dbusuario = 'root';
//$dbsenha = '';
//$dbname = 'cadastro';


$con = mysqli_connect('localhost', 'root', '', 'bar');
//$db = mysqli_select_db($con, 'cadastro');
if (mysqli_connect_error()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   exit();
}
>>>>>>> 6eb96d8238cdd5fe1e009a6430d7fa0ada500c8d
