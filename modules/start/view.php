  <!-- Content Header -->
<section class="content-header">
  <h1>
    <i class="fa fa-home icon-title"></i> Dashboard
  </h1>
  <ol class="breadcrumb">
    <li><a href="?module=start"><i class="fa fa-home"></i> Dashboard</a></li>
  </ol>
</section>

<section class="content">

  <!-- Bienvenida -->
  <div class="row">
    <div class="col-lg-12">
      <div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p style="font-size:15px">
          <i class="icon fa fa-user"></i> Bienvenido <strong><?php echo htmlspecialchars($_SESSION['name_user']); ?></strong> — <?php echo date('l, d \d\e F \d\e Y'); ?>
        </p>
      </div>
    </div>
  </div>

  <?php
  // ── Métricas principales ───────────────────────────────────────────────────
  $q_total_productos = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT COUNT(*) as total, SUM(stock) as total_stock FROM productos"));
  $q_valor_inventario = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT SUM(precio_compra * stock) as valor_compra, SUM(precio_venta * stock) as valor_venta FROM productos"));
  $q_transacciones_hoy = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT COUNT(*) as total FROM transaccion_productos WHERE fecha = CURDATE()"));
  $q_stock_bajo = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT COUNT(*) as total FROM productos WHERE stock <= 5"));

  $valor_compra  = number_format($q_valor_inventario['valor_compra'], 0, '.', ',');
  $valor_venta   = number_format($q_valor_inventario['valor_venta'],  0, '.', ',');
  $ganancia_pot  = number_format($q_valor_inventario['valor_venta'] - $q_valor_inventario['valor_compra'], 0, '.', ',');
  ?>

  <!-- Tarjetas de métricas -->
  <div class="row">

    <div class="col-lg-3 col-xs-6">
      <div class="small-box" style="background-color:#00c0ef;color:#fff">
        <div class="inner">
          <h3><?php echo $q_total_productos['total']; ?></h3>
          <p>Productos registrados</p>
        </div>
        <div class="icon"><i class="fa fa-cubes"></i></div>
        <a href="?module=productos" class="small-box-footer">Ver productos <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box" style="background-color:#00a65a;color:#fff">
        <div class="inner">
          <h3>$ <?php echo $valor_venta; ?></h3>
          <p>Valor del inventario (venta)</p>
        </div>
        <div class="icon"><i class="fa fa-usd"></i></div>
        <a href="?module=stock_inventory" class="small-box-footer">Ver stock <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box" style="background-color:#f39c12;color:#fff">
        <div class="inner">
          <h3><?php echo $q_transacciones_hoy['total']; ?></h3>
          <p>Movimientos hoy</p>
        </div>
        <div class="icon"><i class="fa fa-exchange"></i></div>
        <a href="?module=productos_transaction" class="small-box-footer">Ver registros <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box" style="background-color:<?php echo $q_stock_bajo['total'] > 0 ? '#dd4b39' : '#00a65a'; ?>;color:#fff">
        <div class="inner">
          <h3><?php echo $q_stock_bajo['total']; ?></h3>
          <p>Productos con stock bajo</p>
        </div>
        <div class="icon"><i class="fa fa-warning"></i></div>
        <a href="?module=stock_inventory" class="small-box-footer">Ver detalle <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

  </div><!-- /.row métricas -->

  <div class="row">

    <!-- Gráfica de movimientos del mes -->
    <div class="col-md-8">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-bar-chart"></i> Movimientos del mes — <?php echo date('F Y'); ?></h3>
        </div>
        <div class="box-body">
          <canvas id="chartMovimientos" style="height:280px; width:100%;"></canvas>
        </div>
      </div>
    </div>

    <!-- Resumen financiero -->
    <div class="col-md-4">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-usd"></i> Resumen financiero</h3>
        </div>
        <div class="box-body" style="padding:15px;">
          <table class="table table-bordered" style="margin-bottom:0;">
            <tr>
              <td><i class="fa fa-arrow-down text-red"></i> Valor compra</td>
              <td class="text-right"><strong>$ <?php echo $valor_compra; ?></strong></td>
            </tr>
            <tr>
              <td><i class="fa fa-arrow-up text-green"></i> Valor venta</td>
              <td class="text-right"><strong>$ <?php echo $valor_venta; ?></strong></td>
            </tr>
            <tr style="background:#4e4e4e;">
              <td><i class="fa fa-line-chart text-blue"></i> Ganancia potencial</td>
              <td class="text-right"><strong style="color:#00a65a;">$ <?php echo $ganancia_pot; ?></strong></td>
            </tr>
            <tr>
              <td><i class="fa fa-archive"></i> Unidades en stock</td>
              <td class="text-right"><strong><?php echo number_format($q_total_productos['total_stock']); ?></strong></td>
            </tr>
          </table>
        </div>
      </div>

      <!-- Accesos rápidos -->
      <div class="box box-default">
         <!--<div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-bolt"></i> Acceso rápido</h3>
        </div>
        <div class="box-body" style="padding:10px;">
          <a href="?module=form_productos&form=add" class="btn btn-primary btn-block" style="margin-bottom:8px;">
            <i class="fa fa-plus"></i> Agregar producto
          </a>
          <a href="?module=form_productos_transaction&form=add" class="btn btn-success btn-block" style="margin-bottom:8px;">
            <i class="fa fa-exchange"></i> Registrar entrada/salida
          </a>
          <a href="modules/stock_inventory/print.php" target="_blank" class="btn btn-warning btn-block">
            <i class="fa fa-print"></i> Imprimir reporte de stock
          </a>
        </div>
      </div>-->
    </div>

  </div>

  <div class="row">

    <!-- Últimas transacciones -->
    <div class="col-md-7">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-list"></i> Últimas transacciones</h3>
        </div>
        <div class="box-body no-padding">
          <table class="table table-striped table-hover" style="margin-bottom:0;">
            <thead>
              <tr>
                <th>Transacción</th>
                <th>Fecha</th>
                <th>Producto</th>
                <th class="center">Tipo</th>
                <th class="center">Cant.</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $q_trans = mysqli_query($mysqli, "SELECT t.codigo_transaccion, t.fecha, t.tipo_transaccion, t.numero, p.nombre
                                               FROM transaccion_productos t
                                               INNER JOIN productos p ON t.codigo = p.codigo
                                               ORDER BY t.created_date DESC LIMIT 8")
                                               or die('Error: '.mysqli_error($mysqli));
              while ($row = mysqli_fetch_assoc($q_trans)) {
                $badge = $row['tipo_transaccion'] == 'Entrada'
                  ? '<span class="label label-success">Entrada</span>'
                  : '<span class="label label-danger">Salida</span>';
                $fecha = date('d/m/Y', strtotime($row['fecha']));
                echo "<tr>
                        <td><small>{$row['codigo_transaccion']}</small></td>
                        <td>$fecha</td>
                        <td>{$row['nombre']}</td>
                        <td class='center'>$badge</td>
                        <td class='center'>{$row['numero']}</td>
                      </tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
        <div class="box-footer text-right">
          <a href="?module=productos_transaction">Ver todos <i class="fa fa-arrow-right"></i></a>
        </div>
      </div>
    </div>

    <!-- Alertas de stock bajo -->
    <div class="col-md-5">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-warning"></i> Alertas de stock bajo</h3>
        </div>
        <div class="box-body no-padding">
          <?php
          $q_alertas = mysqli_query($mysqli, "SELECT codigo, nombre, stock, unidad FROM productos WHERE stock <= 5 ORDER BY stock ASC")
                                             or die('Error: '.mysqli_error($mysqli));
          if (mysqli_num_rows($q_alertas) == 0) {
            echo "<div style='padding:15px; text-align:center; color:#00a65a;'>
                    <i class='fa fa-check-circle fa-2x'></i><br>
                    <p style='margin-top:8px;'>Todo el stock está en niveles normales</p>
                  </div>";
          } else {
            echo "<table class='table table-striped' style='margin-bottom:0;'>";
            echo "<thead><tr><th>Producto</th><th class='center'>Stock</th><th class='center'>Unidad</th></tr></thead><tbody>";
            while ($row = mysqli_fetch_assoc($q_alertas)) {
              $color = $row['stock'] == 0 ? 'color:#dd4b39;font-weight:bold;' : 'color:#f39c12;font-weight:bold;';
              echo "<tr>
                      <td>{$row['nombre']}<br><small style='color:#999;'>{$row['codigo']}</small></td>
                      <td class='center' style='$color'>{$row['stock']}</td>
                      <td class='center'>{$row['unidad']}</td>
                    </tr>";
            }
            echo "</tbody></table>";
          }
          ?>
        </div>
      </div>
    </div>

  </div><!-- /.row -->

</section>

<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
<script>
<?php
// Datos para la gráfica — entradas y salidas por día del mes actual
$mes_actual = date('Y-m');
$q_chart = mysqli_query($mysqli, "SELECT DATE(fecha) as dia,
                                         SUM(CASE WHEN tipo_transaccion='Entrada' THEN numero ELSE 0 END) as entradas,
                                         SUM(CASE WHEN tipo_transaccion='Salida'  THEN numero ELSE 0 END) as salidas
                                  FROM transaccion_productos
                                  WHERE DATE_FORMAT(fecha, '%Y-%m') = '$mes_actual'
                                  GROUP BY DATE(fecha)
                                  ORDER BY dia ASC");

$labels   = [];
$entradas = [];
$salidas  = [];

while ($row = mysqli_fetch_assoc($q_chart)) {
  $labels[]   = date('d/m', strtotime($row['dia']));
  $entradas[] = (int)$row['entradas'];
  $salidas[]  = (int)$row['salidas'];
}

echo "var labels   = " . json_encode($labels)   . ";";
echo "var entradas = " . json_encode($entradas) . ";";
echo "var salidas  = " . json_encode($salidas)  . ";";
?>

var isDark = document.body.classList.contains('dark-mode');
var gridColor = isDark ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.05)';

if (labels.length === 0) {
  labels   = ['Sin datos'];
  entradas = [0];
  salidas  = [0];
}

new Chart(document.getElementById('chartMovimientos'), {
  type: 'bar',
  data: {
    labels: labels,
    datasets: [
      { label: 'Entradas', data: entradas, backgroundColor: 'rgba(0,166,90,0.7)', borderColor: '#00a65a', borderWidth: 1 },
      { label: 'Salidas',  data: salidas,  backgroundColor: 'rgba(221,75,57,0.7)',  borderColor: '#dd4b39', borderWidth: 1 }
    ]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: { legend: { display: false } },
    scales: {
      y: { beginAtZero: true, grid: { color: gridColor }, ticks: { stepSize: 1 } },
      x: { grid: { color: gridColor }, ticks: { autoSkip: false, maxRotation: 45 } }
    }
  }
});
</script>

<!-- Leyenda gráfica -->
<div style="text-align:center; margin-top:-10px; margin-bottom:15px; font-size:12px; color:#777; padding-bottom:25px;">
  <span style="display:inline-flex; align-items:center; gap:4px; margin-right:16px;">
    <span style="width:10px;height:10px;border-radius:2px;background:#00a65a;display:inline-block;"></span> Entradas
  </span>
  <span style="display:inline-flex; align-items:center; gap:4px;">
    <span style="width:10px;height:10px;border-radius:2px;background:#dd4b39;display:inline-block;"></span> Salidas
  </span>
</div>