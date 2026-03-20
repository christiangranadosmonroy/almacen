<?php
session_start();
ob_start();

require_once "../../config/database.php";
include "../../config/fungsi_tanggal.php";
include "../../config/fungsi_rupiah.php";

$hari_ini = date("d-m-Y");

$tgl1    = $_GET['tgl_awal'];
$explode = explode('-', $tgl1);
$tgl_awal = $explode[2]."-".$explode[1]."-".$explode[0];

$tgl2      = $_GET['tgl_akhir'];
$explode   = explode('-', $tgl2);
$tgl_akhir = $explode[2]."-".$explode[1]."-".$explode[0];

if (isset($_GET['tgl_awal'])) {
    $no    = 1;
    $query = mysqli_query($mysqli, "SELECT a.tipo_transaccion, a.codigo_transaccion, a.fecha, a.codigo, a.numero, b.codigo, b.nombre, b.unidad
                                    FROM transaccion_productos as a INNER JOIN productos as b ON a.codigo=b.codigo
                                    WHERE a.fecha BETWEEN '$tgl_awal' AND '$tgl_akhir'
                                    ORDER BY a.codigo_transaccion ASC")
                                    or die('error '.mysqli_error($mysqli));
    $count = mysqli_num_rows($query);
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Reporte de productos</title>
        <style>
            body { font-family: Arial, sans-serif; font-size: 11px; }
            #title { text-align: center; font-size: 14px; font-weight: bold; margin-bottom: 5px; }
            #title-tanggal { text-align: center; font-size: 12px; margin-bottom: 5px; }
            table { width: 100%; border-collapse: collapse; }
            th, td { border: 0.3px solid #000; padding: 3px 5px; }
            thead { background: #e8ecee; }
            .center { text-align: center; }
            .right { text-align: right; }
        </style>
    </head>
    <body>
        <div id="title">Datos de registro de los productos</div>
        <?php if ($tgl_awal == $tgl_akhir) { ?>
        <div id="title-tanggal">Fecha <?php echo tgl_eng_to_ind($tgl1); ?></div>
        <?php } else { ?>
        <div id="title-tanggal">Desde <?php echo tgl_eng_to_ind($tgl1); ?> Hasta <?php echo tgl_eng_to_ind($tgl2); ?></div>
        <?php } ?>
        <hr/><br/>
        <table>
            <thead>
                <tr>
                    <th class="center"><small>NO.</small></th>
                    <th class="center"><small>TRANSACCION No.</small></th>
                    <th class="center"><small>FECHA</small></th>
                    <th class="center"><small>CODIGO</small></th>
                    <th class="center"><small>NOMBRE DEL PRODUCTO</small></th>
                    <th class="center"><small>TIPO</small></th>
                    <th class="center"><small>CANT.</small></th>
                    <th class="center"><small>UNIDAD</small></th>
                </tr>
            </thead>
            <tbody>
        <?php
        if ($count == 0) {
            echo "<tr><td colspan='8' class='center'>Sin registros</td></tr>";
        } else {
            while ($data = mysqli_fetch_assoc($query)) {
                $tanggal = $data['fecha'];
                $exp     = explode('-', $tanggal);
                $fecha   = $exp[2]."-".$exp[1]."-".$exp[0];

                echo "<tr>
                        <td class='center'>$no</td>
                        <td class='center'>{$data['codigo_transaccion']}</td>
                        <td class='center'>$fecha</td>
                        <td class='center'>{$data['codigo']}</td>
                        <td>{$data['nombre']}</td>
                        <td class='center'>{$data['tipo_transaccion']}</td>
                        <td class='center'>{$data['numero']}</td>
                        <td class='center'>{$data['unidad']}</td>
                      </tr>";
                $no++;
            }
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
    $html2pdf->output('datos_registro_productos.pdf');
} catch (Spipu\Html2Pdf\Exception\Html2PdfException $e) {
    echo $e->getMessage();
}
?>