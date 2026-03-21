
<?php

// Configurar cookies de sesión seguras ANTES de session_start()
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'Strict');
session_start();

require_once "config/database.php";

$username = mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars(trim($_POST['username'])))));
$password = md5(mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars(trim($_POST['password']))))));

if (!ctype_alnum($username) OR !ctype_alnum($password)) {
    header("Location: index.php?alert=1");
    exit;
}

$query = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE username='$username' AND password='$password' AND status='activo'")
                                or die('error'.mysqli_error($mysqli));
$rows  = mysqli_num_rows($query);

if ($rows > 0) {
    $data = mysqli_fetch_assoc($query);

    // Regenerar ID de sesión para prevenir session fixation
    session_regenerate_id(true);

    $_SESSION['id_user']         = $data['id_user'];
    $_SESSION['username']        = $data['username'];
    $_SESSION['password']        = $data['password'];
    $_SESSION['name_user']       = $data['name_user'];
    $_SESSION['permisos_acceso'] = $data['permisos_acceso'];

    header("Location: main.php?module=start");
    exit;
} else {
    header("Location: index.php?alert=1");
    exit;
}
?>