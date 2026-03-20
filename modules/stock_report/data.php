<?php
session_start();
require_once "../../config/database.php";

if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo json_encode([]);
    exit;
}

$tgl1    = isset($_GET['tgl_awal'])  ? $_GET['tgl_awal']  : '';
$tgl2    = isset($_GET['tgl_akhir']) ? $_GET['tgl_akhir'] : '';

if (!$tgl1 || !$tgl2) {
    echo json_encode([]);
    exit;
}

// Convertir de dd-mm-yyyy a yyyy-mm-dd para la query
$exp1    = explode('-', $tgl1);
$tgl_awal = $exp1[2]."-".$exp1[1]."-".$exp1[0];

$exp2      = explode('-', $tgl2);
$tgl_akhir = $exp2[2]."-".$exp2[1]."-".$exp2[0];

$tgl_awal  = mysqli_real_escape_string($mysqli, $tgl_awal);
$tgl_akhir = mysqli_real_escape_string($mysqli, $tgl_akhir);

$query = mysqli_query($mysqli, "SELECT a.tipo_transaccion, a.codigo_transaccion, a.fecha, a.codigo, a.numero, b.nombre, b.unidad
                                FROM transaccion_productos as a 
                                INNER JOIN productos as b ON a.codigo = b.codigo
                                WHERE a.fecha BETWEEN '$tgl_awal' AND '$tgl_akhir'
                                ORDER BY a.codigo_transaccion ASC")
                                or die('error '.mysqli_error($mysqli));

$result = [];
while ($row = mysqli_fetch_assoc($query)) {
    // Formatear fecha de yyyy-mm-dd a dd-mm-yyyy para mostrar
    $exp   = explode('-', $row['fecha']);
    $fecha = $exp[2]."-".$exp[1]."-".$exp[0];

    $result[] = [
        'codigo_transaccion' => $row['codigo_transaccion'],
        'fecha'              => $fecha,
        'codigo'             => $row['codigo'],
        'nombre'             => $row['nombre'],
        'tipo_transaccion'   => $row['tipo_transaccion'],
        'numero'             => $row['numero'],
        'unidad'             => $row['unidad'],
    ];
}

header('Content-Type: application/json');
echo json_encode($result);
?>