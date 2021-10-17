
<?php
session_start();


require_once "../../config/database.php";

if (empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}

else {
    if ($_GET['act']=='insert') {
        if (isset($_POST['Guardar'])) {
     
            $codigo  = mysqli_real_escape_string($mysqli, trim($_POST['codigo']));
            $nombre  = mysqli_real_escape_string($mysqli, trim($_POST['nombre']));
            $pcompra = str_replace('.', '', mysqli_real_escape_string($mysqli, trim($_POST['pcompra'])));
            $pventa = str_replace('.', '', mysqli_real_escape_string($mysqli, trim($_POST['pventa'])));
            $stock = str_replace('.', '', mysqli_real_escape_string($mysqli, trim($_POST['stock'])));
            $unidad     = mysqli_real_escape_string($mysqli, trim($_POST['unidad']));

            $created_user = $_SESSION['id_user'];

  
            $query = mysqli_query($mysqli, "INSERT INTO productos(codigo,nombre,precio_compra,precio_venta,stock,unidad,created_user,updated_user) 
                                            VALUES('$codigo','$nombre','$pcompra','$pventa','$stock','$unidad','$created_user','$created_user')")
                                            or die('error '.mysqli_error($mysqli));    

        
            if ($query) {
         
                header("location: ../../main.php?module=productos&alert=1");
            }   
        }   
    }
    
    elseif ($_GET['act']=='update') {
        if (isset($_POST['Guardar'])) {
            if (isset($_POST['codigo'])) {
        
                $codigo  = mysqli_real_escape_string($mysqli, trim($_POST['codigo']));
                $nombre  = mysqli_real_escape_string($mysqli, trim($_POST['nombre']));
                $pcompra = str_replace('.', '', mysqli_real_escape_string($mysqli, trim($_POST['pcompra'])));
                $pventa = str_replace('.', '', mysqli_real_escape_string($mysqli, trim($_POST['pventa'])));
                $stock = str_replace('.', '', mysqli_real_escape_string($mysqli, trim($_POST['stock'])));
                $unidad     = mysqli_real_escape_string($mysqli, trim($_POST['unidad']));

                $updated_user = $_SESSION['id_user'];

                $query = mysqli_query($mysqli, "UPDATE productos SET  nombre       = '$nombre',
                                                                    precio_compra      = '$pcompra',
                                                                    precio_venta      = '$pventa',
                                                                    stock             = '$stock',
                                                                    unidad          = '$unidad',
                                                                    updated_user    = '$updated_user'
                                                              WHERE codigo       = '$codigo'")
                                                or die('error: '.mysqli_error($mysqli));

    
                if ($query) {
                  
                    header("location: ../../main.php?module=productos&alert=2");
                }         
            }
        }
    }

    elseif ($_GET['act']=='delete') {
        if (isset($_GET['id'])) {
            $codigo = $_GET['id'];
      
            $query = mysqli_query($mysqli, "DELETE FROM productos WHERE codigo='$codigo'")
                                            or die('error '.mysqli_error($mysqli));


            if ($query) {
     
                header("location: ../../main.php?module=productos&alert=3");
            }
        }
    }       
}       
?>