
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login | Inventario</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="PalabandaMexico"/>

    <!-- favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.png" />

    <!--Fonts google-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <!-- Bootstrap 3.3.2 -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="assets/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>

  </head>
  <body  class="login-page bg-login bg-custom" >
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="login-logo">
        <img style="margin-top:-12px" src="assets/img/palabanda.png" alt="Logo" height="50">
      </div>
      <?php  
 
      if (empty($_GET['alert'])) {
        echo "";
      } 

      elseif ($_GET['alert'] == 1) {
        echo "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-times-circle'></i> Error al entrar!</h4>
               Usuario o la contraseña es incorrecta, vuelva a verificar su nombre de usuario y contraseña.
              </div>";
      }

      elseif ($_GET['alert'] == 2) {
        echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exito!!</h4>
              Has salido con éxito.
              </div>";
      }
      ?>

      <div class="login-box-body custom-login-box-body">
        <p class="login-box-msg custom-login-box-msg">Inicio de sesión</p>
        <br>
        <form action="login-check.php" method="POST">
          <div class="form-group has-feedback ">
            <label for="username">Nombre de usuario</label>
            <input type="text" class="form-control" name="username" autocomplete="off" required />
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
          <label for="password">Contraseña</label>
            <input type="password" class="form-control" name="password" required />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <br/>
          <div class="row">
            <div class="col-xs-12">
              <input type="submit" class="btn btn-custom btn-lg btn-block btn-flat" name="login" value="Ingresar" />
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

  </body>
</html>