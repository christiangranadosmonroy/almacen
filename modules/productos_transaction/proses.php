<?php
session_start();

require_once "../../config/database.php";

if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    $_SESSION['alert'] = 1;
    header("Location: ../../index.php");
    exit;
}

if ($_GET['act'] == 'insert') {
    if (isset($_POST['Guardar'])) {

        $fecha            = mysqli_real_escape_string($mysqli, trim($_POST['fecha_a']));
        $exp              = explode('-', $fecha);
        $fecha_a          = $exp[2]."-".$exp[1]."-".$exp[0];

        $codigo           = mysqli_real_escape_string($mysqli, trim($_POST['codigo']));
        $num              = mysqli_real_escape_string($mysqli, trim($_POST['num']));
        $total_stock      = mysqli_real_escape_string($mysqli, trim($_POST['total_stock']));
        $tipo_transaccion = mysqli_real_escape_string($mysqli, trim($_POST['transaccion']));
        $created_user     = $_SESSION['id_user'];
        $tahun            = date("Y");

        // Obtener el último código del año actual ordenando por created_date
        $query_id = mysqli_query($mysqli, "SELECT codigo_transaccion FROM transaccion_productos
                                           WHERE codigo_transaccion LIKE 'TM-$tahun-%'
                                           ORDER BY created_date DESC LIMIT 1")
                                           or die('Error: '.mysqli_error($mysqli));

        if (mysqli_num_rows($query_id) > 0) {
            $data_id    = mysqli_fetch_assoc($query_id);
            $last_code  = $data_id['codigo_transaccion'];
            $num_codigo = (int)substr($last_code, -7) + 1;
        } else {
            $num_codigo = 1;
        }

        $buat_id            = str_pad($num_codigo, 7, "0", STR_PAD_LEFT);
        $codigo_transaccion = mysqli_real_escape_string($mysqli, "TM-$tahun-$buat_id");

        $query = mysqli_query($mysqli, "INSERT INTO transaccion_productos(codigo_transaccion,fecha,codigo,numero,created_user,tipo_transaccion) 
                                        VALUES('$codigo_transaccion','$fecha_a','$codigo','$num','$created_user','$tipo_transaccion')");

        if (!$query) {
            $errno = mysqli_errno($mysqli);
            if ($errno == 1062) {
                $num_codigo++;
                $buat_id            = str_pad($num_codigo, 7, "0", STR_PAD_LEFT);
                $codigo_transaccion = mysqli_real_escape_string($mysqli, "TM-$tahun-$buat_id");

                $query = mysqli_query($mysqli, "INSERT INTO transaccion_productos(codigo_transaccion,fecha,codigo,numero,created_user,tipo_transaccion) 
                                                VALUES('$codigo_transaccion','$fecha_a','$codigo','$num','$created_user','$tipo_transaccion')")
                                                or die('Error: '.mysqli_error($mysqli));
            } else {
                die('Error: '.mysqli_error($mysqli));
            }
        }

        if ($query) {
            $query1 = mysqli_query($mysqli, "UPDATE productos SET stock = '$total_stock'
                                             WHERE codigo = '$codigo'")
                                             or die('Error: '.mysqli_error($mysqli));
            if ($query1) {
                header("location: ../../main.php?module=productos_transaction&alert=1");
                exit;
            }
        }
    }
}
?>