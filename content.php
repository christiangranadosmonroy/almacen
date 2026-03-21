<?php
require_once "config/database.php";
require_once "config/fungsi_tanggal.php";
require_once "config/fungsi_rupiah.php";

if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    $_SESSION['alert'] = 1;
    header("Location: index.php");
    exit;
} else {
    $module = $_GET['module'] ?? 'start';

    if ($module == 'start') {
        include "modules/start/view.php";

    } elseif ($module == 'productos') {
        include "modules/productos/view.php";

    } elseif ($module == 'form_productos') {
        include "modules/productos/form.php";

    } elseif ($module == 'productos_transaction') {
        include "modules/productos_transaction/view.php";

    } elseif ($module == 'form_productos_transaction') {
        include "modules/productos_transaction/form.php";

    } elseif ($module == 'stock_inventory') {
        include "modules/stock_inventory/view.php";

    } elseif ($module == 'stock_report') {
        include "modules/stock_report/view.php";

    } elseif ($module == 'user') {
        include "modules/user/view.php";

    } elseif ($module == 'form_user') {
        include "modules/user/form.php";

    } elseif ($module == 'profile') {
        include "modules/profile/view.php";

    } elseif ($module == 'form_profile') {
        include "modules/profile/form.php";

    } elseif ($module == 'password') {
        include "modules/password/view.php";
    }
}
?>