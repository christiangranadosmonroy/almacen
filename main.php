<?php  
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Panel de administración | Inventario de Productos</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="Inventario de Productos">
    <meta name="Xolotl Tech" content="Inventario de Productos - Xolotl Tech" />
    
    <!-- favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" />

    <!-- Bootstrap 3.3.2 -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />  
    <!-- DATA TABLES -->
    <link href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Datepicker -->
    <link href="assets/plugins/datepicker/datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Chosen Select -->
    <link rel="stylesheet" type="text/css" href="assets/plugins/chosen/css/chosen.min.css" />
    <!-- Theme style -->
    <link href="assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skin -->
    <link href="assets/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <!-- Dark Mode CSS -->
    <link href="assets/css/darkmode.css" rel="stylesheet" type="text/css" />

    <!-- Aplicar dark mode ANTES de renderizar para evitar flash -->
    <script>
      (function() {
        var saved = localStorage.getItem('darkMode');
        var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        if (saved === 'true' || (saved === null && prefersDark)) {
          document.documentElement.classList.add('dark-mode-pending');
        }
      })();
    </script>
    <style>
      html.dark-mode-pending body { background-color: #1a1a2e !important; }
    </style>

    <script language="javascript">
      function getkey(e) {
        if (window.event) return window.event.keyCode;
        else if (e) return e.which;
        else return null;
      }

      function goodchars(e, goods, field) {
        var key, keychar;
        key = getkey(e);
        if (key == null) return true;
        keychar = String.fromCharCode(key);
        keychar = keychar.toLowerCase();
        goods = goods.toLowerCase();
        if (goods.indexOf(keychar) != -1) return true;
        if (key==null || key==0 || key==8 || key==9 || key==27) return true;
        if (key == 13) {
          var i;
          for (i = 0; i < field.form.elements.length; i++)
            if (field == field.form.elements[i]) break;
          i = (i + 1) % field.form.elements.length;
          field.form.elements[i].focus();
          return false;
        }
        return false;
      }
    </script>

  </head>
  <body class="skin-blue fixed">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="?module=start" class="logo">
          <img style="margin-top:-15px;margin-right:5px; height: 45px;" src="assets/img/Logo xolotl.webp" alt="Logo">
        </a>

        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- Botón Dark Mode -->
              <li>
                <button id="dark-mode-toggle" title="Cambiar tema">
                  <i id="dark-mode-icon" class="fa fa-moon-o"></i>
                  <span id="dark-mode-label">Oscuro</span>
                </button>
              </li>

              <?php include "top-menu.php" ?>
              
            </ul>
          </div>
        </nav>
      </header>

      <aside class="main-sidebar">
        <section class="sidebar">
          <?php include "sidebar-menu.php" ?>
        </section>
      </aside>

      <div class="content-wrapper">

        <?php include "content.php" ?>

        <!-- Modal Logout -->
        <div class="modal fade" id="logout">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-sign-out"> Salir</i></h4>
              </div>
              <div class="modal-body">
                <p>¿Seguro que quieres salir?</p>
              </div>
              <div class="modal-footer">
                <a type="button" class="btn btn-danger" href="logout.php">Si, Salir</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </div>
        </div>

      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <strong>Todos los derechos reservados @Xolotl Tech 2026</strong>
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>    
    <!-- datepicker -->
    <script src="assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- chosen select -->
    <script src="assets/plugins/chosen/js/chosen.jquery.min.js"></script>
    <!-- DATA TABLES SCRIPT -->
    <script src="assets/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- Datepicker -->
    <script src="assets/plugins/datepicker/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- maskMoney -->
    <script src="assets/js/jquery.maskMoney.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/js/app.min.js" type="text/javascript"></script>

    <script type="text/javascript">

      // ── Dark Mode ──────────────────────────────────────────
      var darkModeToggle = document.getElementById('dark-mode-toggle');
      var darkModeIcon   = document.getElementById('dark-mode-icon');
      var darkModeLabel  = document.getElementById('dark-mode-label');

      function applyDarkMode(active) {
        if (active) {
          document.body.classList.add('dark-mode');
          darkModeIcon.className  = 'fa fa-sun-o';
          darkModeLabel.textContent = 'Claro';
          localStorage.setItem('darkMode', 'true');
        } else {
          document.body.classList.remove('dark-mode');
          darkModeIcon.className  = 'fa fa-moon-o';
          darkModeLabel.textContent = 'Oscuro';
          localStorage.setItem('darkMode', 'false');
        }
      }

      // Inicializar según preferencia guardada o del sistema
      var saved = localStorage.getItem('darkMode');
      var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
      applyDarkMode(saved === 'true' || (saved === null && prefersDark));

      // Escuchar cambios automáticos del sistema (solo si el user no eligió manualmente)
      if (window.matchMedia) {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
          if (localStorage.getItem('darkMode') === null) {
            applyDarkMode(e.matches);
          }
        });
      }

      // Toggle manual
      darkModeToggle.addEventListener('click', function() {
        applyDarkMode(!document.body.classList.contains('dark-mode'));
      });
      // ── Fin Dark Mode ──────────────────────────────────────

      $(function () {
        $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        });

        $('.chosen-select').chosen({allow_single_deselect:true}); 
        
        $('#harga_beli').maskMoney({thousands:'.', decimal:',', precision:0});
        $('#harga_jual').maskMoney({thousands:'.', decimal:',', precision:0});

        $(window)
        .off('resize.chosen')
        .on('resize.chosen', function() {
          $('.chosen-select').each(function() {
            var $this = $(this);
            $this.next().css({'width': $this.parent().width()});
          })
        }).trigger('resize.chosen');

        $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
          if(event_name != 'sidebar_collapsed') return;
          $('.chosen-select').each(function() {
            var $this = $(this);
            $this.next().css({'width': $this.parent().width()});
          })
        });
    
        $('#chosen-multiple-style .btn').on('click', function(e){
          var target = $(this).find('input[type=radio]');
          var which = parseInt(target.val());
          if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
          else $('#form-field-select-4').removeClass('tag-input-style');
        });

        $("#dataTables1").dataTable();
        $('#dataTables2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false,
          "language": idioma_español
        });
      });

      var idioma_español = {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      }
    </script>

  </body>
</html>