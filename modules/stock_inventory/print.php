<?php
session_start();
ob_start();

require_once "../../config/database.php";
include "../../config/fungsi_tanggal.php";
include "../../config/fungsi_rupiah.php";

$hari_ini = date("d-m-Y");

$query = mysqli_query($mysqli, "SELECT codigo,nombre,precio_compra,precio_venta,unidad,stock FROM productos ORDER BY nombre ASC")
                                or die('Error '.mysqli_error($mysqli));
$count = mysqli_num_rows($query);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Informes de stock de los Productos</title>
        <style>
            body { font-family: Arial, sans-serif; font-size: 11px; }
            #title { text-align: center; font-size: 14px; font-weight: bold; margin-bottom: 5px; }
            table { width: 100%; border-collapse: collapse; }
            th, td { border: 0.3px solid #000; padding: 3px 5px; }
            thead { background: #e8ecee; }
            .center { text-align: center; }
            .right { text-align: right; }
        </style>
    </head>
    <body>
        <div id="title">Stock de productos</div>
        <hr/>
        <br/>
        <table>
            <thead>
                <tr>
                    <th class="center"><small>NO.</small></th>
                    <th class="center"><small>CODIGO</small></th>
                    <th class="center"><small>PRODUCTO</small></th>
                    <th class="center"><small>PRECIO DE COMPRA</small></th>
                    <th class="center"><small>PRECIO DE VENTA</small></th>
                    <th class="center"><small>STOCK</small></th>
                    <th class="center"><small>UNIDAD</small></th>
                </tr>
            </thead>
            <tbody>
        <?php
        $no = 1;
        while ($data = mysqli_fetch_assoc($query)) {
            $precio_compra = format_rupiah($data['precio_compra']);
            $precio_venta  = format_rupiah($data['precio_venta']);
            echo "<tr>
                    <td class='center'>$no</td>
                    <td class='center'>{$data['codigo']}</td>
                    <td>{$data['nombre']}</td>
                    <td class='right'>$. $precio_compra</td>
                    <td class='right'>$. $precio_venta</td>
                    <td class='right'>{$data['stock']}</td>
                    <td class='center'>{$data['unidad']}</td>
                  </tr>";
            $no++;
        }
        ?>
            </tbody>
        </table>
    </body>
</html>
<?php
$content = ob_get_clean();

// Usar la nueva librería instalada con Composer
require_once('../../vendor/autoload.php');

try {
    $html2pdf = new Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'es', true, 'UTF-8', array(10, 10, 10, 10));
    $html2pdf->writeHTML($content);
    $html2pdf->output('INFORME_STOCK.pdf');
} catch (Spipu\Html2Pdf\Exception\Html2PdfException $e) {
    echo $e->getMessage();
}
?>