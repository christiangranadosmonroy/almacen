
<?php

$server   = "localhost";
$username = "root";
$password = "Chris162754";
$database = "medisys";


$mysqli = new mysqli($server, $username, $password, $database);


if ($mysqli->connect_error) {
    die('no conecta pendejo'.$mysqli->connect_error);
}
?>