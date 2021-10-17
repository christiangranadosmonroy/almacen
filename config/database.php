
<?php

$server   = "localhost";
$username = "christian";
$password = "";
$database = "palabanda_almacen";


$mysqli = new mysqli($server, $username, $password, $database);


if ($mysqli->connect_error) {
    die('parece que no se encuentra la pagina'.$mysqli->connect_error);
}
?>