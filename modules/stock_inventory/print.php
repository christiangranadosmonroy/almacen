<?php
session_start();
ob_start();

require_once "../../config/database.php";
include "../../config/fungsi_tanggal.php";
include "../../config/fungsi_rupiah.php";

$fecha_impresion = date("d-m-Y H:i:s");
$fecha_corta     = date("d-m-Y");

$query = mysqli_query($mysqli, "SELECT codigo, nombre, precio_compra, precio_venta, unidad, stock,
                                       (precio_venta - precio_compra) as ganancia,
                                       ROUND((precio_venta - precio_compra) / precio_compra * 100, 1) as margen
                                FROM productos ORDER BY nombre ASC")
                                or die('Error '.mysqli_error($mysqli));
$count = mysqli_num_rows($query);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Informe de Stock — <?php echo $fecha_corta; ?></title>
        <style>
            body { font-family: Arial, sans-serif; font-size: 10px; }

            #header { width: 100%; margin-bottom: 4px; }
            #header td { vertical-align: middle; }

            #title { font-size: 15px; font-weight: bold; text-align: center; }
            #subtitle { font-size: 10px; text-align: center; color: #555; margin-top: 2px; }

            #meta { font-size: 9px; text-align: right; color: #555; }

            hr { border: none; border-top: 1px solid #aaa; margin: 6px 0; }

            table { width: 100%; border-collapse: collapse; }
            th, td { border: 0.3px solid #999; padding: 3px 5px; }
            thead tr { background: #2c3e50; color: #fff; }
            thead th { font-size: 9px; }
            tbody tr:nth-child(even) { background: #f5f5f5; }

            .center { text-align: center; }
            .right  { text-align: right; }
            .verde  { color: #27ae60; font-weight: bold; }
            .rojo   { color: #e74c3c; font-weight: bold; }
            .naranja { color: #e67e22; font-weight: bold; }

            #footer { margin-top: 10px; font-size: 9px; color: #777; text-align: right; }
        </style>
    </head>
    <body>

        <table id="header">
            <tr>
                <td width="70%">
                    <div id="title">Informe de Stock de Productos</div>
                    <div id="subtitle">Xolotl Tech — Inventario</div>
                </td>
                <td width="30%">
                    <div id="meta">
                        <strong>Fecha de impresión:</strong><br/>
                        <?php echo $fecha_impresion; ?>
                    </div>
                </td>
            </tr>
        </table>

        <hr/>

        <table>
            <thead>
                <tr>
                    <th class="center">NO.</th>
                    <th class="center">CODIGO</th>
                    <th>PRODUCTO</th>
                    <th class="center">PRECIO COMPRA</th>
                    <th class="center">PRECIO VENTA</th>
                    <th class="center">GANANCIA</th>
                    <th class="center">MARGEN</th>
                    <th class="center">STOCK</th>
                    <th class="center">UNIDAD</th>
                </tr>
            </thead>
            <tbody>
        <?php
        $no = 1;
        while ($data = mysqli_fetch_assoc($query)) {
            $precio_compra = format_rupiah($data['precio_compra']);
            $precio_venta  = format_rupiah($data['precio_venta']);
            $ganancia      = format_rupiah(abs($data['ganancia']));
            $margen        = $data['margen'];

            // Color según margen
            if ($data['ganancia'] < 0) {
                $clase  = 'rojo';
                $signo  = '-';
                $flecha = '▼';
            } elseif ($margen < 10) {
                $clase  = 'naranja';
                $signo  = '+';
                $flecha = '→';
            } else {
                $clase  = 'verde';
                $signo  = '+';
                $flecha = '▲';
            }

            echo "<tr>
                    <td class='center'>$no</td>
                    <td class='center'>{$data['codigo']}</td>
                    <td>{$data['nombre']}</td>
                    <td class='right'>$ $precio_compra</td>
                    <td class='right'>$ $precio_venta</td>
                    <td class='right $clase'>$signo $ $ganancia</td>
                    <td class='center $clase'>$margen% $flecha</td>
                    <td class='right'>{$data['stock']}</td>
                    <td class='center'>{$data['unidad']}</td>
                  </tr>";
            $no++;
        }
        ?>
            </tbody>
        </table>

        <div id="footer">
            Total de productos: <?php echo $count; ?> &nbsp;|&nbsp;
            Generado el <?php echo $fecha_impresion; ?> &nbsp;|&nbsp;
            Xolotl Tech
        </div>

    </body>
</html>
<?php
$content = ob_get_clean();

require_once('../../vendor/autoload.php');

try {
    $html2pdf = new Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'es', true, 'UTF-8', array(10, 10, 10, 10));
    $html2pdf->writeHTML($content);
    $html2pdf->output('INFORME_STOCK_' . date('d-m-Y') . '.pdf');
} catch (Spipu\Html2Pdf\Exception\Html2PdfException $e) {
    echo $e->getMessage();
}
?>