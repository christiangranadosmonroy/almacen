<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-file-text-o icon-title"></i>Informe de datos de registro de los productos
  </h1>
  <ol class="breadcrumb">
    <li><a href="?module=start"><i class="fa fa-home"></i> Dashboard</a></li>
    <li class="active">informe</li>
    <li class="active"> registro de productos</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">

      <div class="box box-primary">
        <div class="box-body">
          <div class="form-horizontal">
            <div class="form-group" style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">

              <label style="margin:0 5px 0 15px;">Fecha</label>
              <input type="text" id="tgl_awal" class="form-control date-picker" data-date-format="dd-mm-yyyy" autocomplete="off" style="width:140px;" placeholder="dd-mm-yyyy">

              <label style="margin:0 5px;">Hasta</label>
              <input type="text" id="tgl_akhir" class="form-control date-picker" data-date-format="dd-mm-yyyy" autocomplete="off" style="width:140px;" placeholder="dd-mm-yyyy">

              <button type="button" id="btn-buscar" class="btn btn-info" style="margin-left:10px;">
                <i class="fa fa-search"></i> Buscar
              </button>

              <div style="margin-left:auto; margin-right:15px;">
                <a id="btn-imprimir" href="#" target="_blank" class="btn btn-primary btn-social" style="display:none; width:130px;">
                  <i class="fa fa-print"></i> Imprimir
                </a>
              </div>

            </div>
          </div>
        </div>
      </div>

      <!-- Preview de resultados -->
      <div id="preview-box" style="display:none;">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-table"></i> Vista previa</h3>
          </div>
          <div class="box-body">
            <table id="tabla-preview" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th class="center">No.</th>
                  <th class="center">Transacción No.</th>
                  <th class="center">Fecha</th>
                  <th class="center">Código</th>
                  <th>Nombre del Producto</th>
                  <th class="center">Tipo</th>
                  <th class="center">Cant.</th>
                  <th class="center">Unidad</th>
                </tr>
              </thead>
              <tbody id="tbody-preview">
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div><!--/.col -->
  </div><!-- /.row -->
</section><!-- /.content -->

<script>
document.getElementById('btn-buscar').addEventListener('click', function() {
  var tgl_awal  = document.getElementById('tgl_awal').value;
  var tgl_akhir = document.getElementById('tgl_akhir').value;

  if (!tgl_awal || !tgl_akhir) {
    alert('Por favor selecciona ambas fechas.');
    return;
  }

  // Llamada AJAX para obtener los datos
  $.ajax({
    url: 'modules/stock_report/data.php',
    type: 'GET',
    data: { tgl_awal: tgl_awal, tgl_akhir: tgl_akhir },
    dataType: 'json',
    success: function(data) {
      var tbody = document.getElementById('tbody-preview');
      tbody.innerHTML = '';

      if (data.length === 0) {
        tbody.innerHTML = '<tr><td colspan="8" class="center">Sin registros en este período</td></tr>';
      } else {
        for (var i = 0; i < data.length; i++) {
          var r = data[i];
          tbody.innerHTML += '<tr>' +
            '<td class="center">' + (i+1) + '</td>' +
            '<td class="center">' + r.codigo_transaccion + '</td>' +
            '<td class="center">' + r.fecha + '</td>' +
            '<td class="center">' + r.codigo + '</td>' +
            '<td>' + r.nombre + '</td>' +
            '<td class="center">' + r.tipo_transaccion + '</td>' +
            '<td class="center">' + r.numero + '</td>' +
            '<td class="center">' + r.unidad + '</td>' +
          '</tr>';
        }
      }

      // Mostrar preview y botón imprimir
      document.getElementById('preview-box').style.display = 'block';
      var btnImprimir = document.getElementById('btn-imprimir');
      btnImprimir.href = 'modules/stock_report/print.php?tgl_awal=' + tgl_awal + '&tgl_akhir=' + tgl_akhir;
      btnImprimir.style.display = 'inline-block';
    },
    error: function() {
      alert('Error al obtener los datos.');
    }
  });
});
</script>