<?php 

if ($_SESSION['permisos_acceso']=='Super Admin') { ?>

    <ul class="sidebar-menu">
	<?php 

	if ($_GET["module"]=="start") { 
		$active_home="active";
	} else {
		$active_home="";
	}
	?>
		<li class="<?php echo $active_home;?>">
			<a class="slide-text-custom" href="?module=start"><i class="fa fa-home"></i> Inicio </a>
	  	</li>
	<?php

  if ($_GET["module"]=="productos" || $_GET["module"]=="form_productos") { ?>
    <li  class="active">
      <a class="slide-text-custom" href="?module=productos"><i class="fa fa-folder"></i> Datos de productos </a>
      </li>
  <?php
  }

  else { ?>
    <li  >
      <a class="slide-text-custom"  href="?module=productos"><i class="fa fa-folder"></i> Datos de Productos </a>
      </li>
  <?php
  }


  if ($_GET["module"]=="productos_transaction" || $_GET["module"]=="form_productos_transaction") { ?>
    <li class="active">
      <a class="slide-text-custom"  href="?module=productos_transaction"><i class="fa fa-clone"></i> Registro de productos </a>
      </li>
  <?php
  }

  else { ?>
    <li  >
      <a class="slide-text-custom" href="?module=productos_transaction"><i class="fa fa-clone"></i> Registro de productos </a>
      </li>
  <?php
  }

	if ($_GET["module"]=="stock_inventory") { ?>
		<li   class="active treeview">
          	<a class="slide-text-custom" href="javascript:void(0);">
            	<i  class="fa fa-file-text"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li   class="active"><a class="slide-text-custom" href="?module=stock_inventory"><i class="fa fa-circle-o"></i> Stock de Productos </a></li>
        		<li  ><a class="slide-text-custom" href="?module=stock_report"><i class="fa fa-circle-o"></i> Registro de Productos</a></li>
      		</ul>
    	</li>
    <?php
	}

	elseif ($_GET["module"]=="stock_report") { ?>
		<li style="slide-text-custom"  class="active treeview">
          	<a class="slide-text-custom" href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li style="slide-text-custom" ><a href="?module=stock_inventory"><i class="fa fa-circle-o"></i> Stock de Productos </a></li>
        		<li  style="slide-text-custom" class="active"><a href="?module=stock_report"><i class="fa fa-circle-o"></i> Registro de Productos </a></li>
      		</ul>
    	</li>
    <?php
	}

	else { ?>
		<li  style="slide-text-custom" class="treeview">
          	<a class="slide-text-custom" href="javascript:void(0);">
            	<i class="fa fa-file-text"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a  class="slide-text-custom"href="?module=stock_inventory"><i class="fa fa-circle-o"></i> Stock de Productos </a></li>
        		<li><a class="slide-text-custom" href="?module=stock_report"><i class="fa fa-circle-o"></i> Registro de Productos </a></li>
      		</ul>
    	</li>
    <?php
	}


	if ($_GET["module"]=="user" || $_GET["module"]=="form_user") { ?>
		<li class="active">
			<a class="slide-text-custom" href="?module=user"><i class="fa fa-user"></i> Administrar usuarios</a>
	  	</li>
	<?php
	}

	else { ?>
		<li>
			<a class="slide-text-custom" href="?module=user"><i class="fa fa-user"></i> Administrar usuarios</a>
	  	</li>
	<?php
	}


	if ($_GET["module"]=="password") { ?>
		<li class="active">
			<a class="slide-text-custom" href="?module=password"><i class="fa fa-lock"></i> Cambiar contraseña</a>
		</li>
	<?php
	}

	else { ?>
		<li>
			<a class="slide-text-custom" href="?module=password"><i class="fa fa-lock"></i> Cambiar contraseña</a>
		</li>
	<?php
	}
	?>
	</ul>

<?php
}

elseif ($_SESSION['permisos_acceso']=='Gerente') { ?>
	<!-- sidebar menu start -->
    <ul class="sidebar-menu">
	<?php 

	if ($_GET["module"]=="start") { ?>
		<li style="slide-text-custom"  class="active">
			<a href="?module=start"><i class="fa fa-home"></i> Inicio </a>
	  	</li>
	<?php
	}

	else { ?>
		<li style="slide-text-custom" >
			<a href="?module=start"><i class="fa fa-home"></i> Inicio </a>
	  	</li>
	<?php
	}


  if ($_GET["module"]=="stock_inventory") { ?>
    <li style="slide-text-custom"  class="active treeview">
            <a href="javascript:void(0);">
              <i class="fa fa-file-text"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
          <ul class="treeview-menu">
            <li style="slide-text-custom"  class="active"><a href="?module=stock_inventory"><i class="fa fa-circle-o"></i> Stock de Productos</a></li>
            <li style="slide-text-custom" ><a href="?module=stock_report"><i class="fa fa-circle-o"></i> Registro de Productos </a></li>
          </ul>
      </li>
    <?php
  }
  elseif ($_GET["module"]=="stock_report") { ?>
    <li  style="slide-text-custom" class="active treeview">
            <a href="javascript:void(0);">
              <i class="fa fa-file-text"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
          <ul class="treeview-menu">
            <li><a href="?module=stock_inventory"><i class="fa fa-circle-o"></i> Stock de Productos </a></li>
            <li class="active"><a href="?module=stock_report"><i class="fa fa-circle-o"></i> Registro de Productos </a></li>
          </ul>
      </li>
    <?php
  }
  else { ?>
    <li style="slide-text-custom"  class="treeview">
            <a href="javascript:void(0);">
              <i class="fa fa-file-text"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
          <ul class="treeview-menu">
            <li style="slide-text-custom" ><a href="?module=stock_inventory"><i class="fa fa-circle-o"></i>  Stock de Productos </a></li>
            <li style="slide-text-custom" ><a href="?module=stock_report"><i class="fa fa-circle-o"></i> Registro de Productos </a></li>
          </ul>
      </li>
    <?php
  }

	if ($_GET["module"]=="password") { ?>
		<li style="slide-text-custom"  class="active">
			<a href="?module=password"><i class="fa fa-lock"></i> Cambiar contraseña</a>
		</li>
	<?php
	}
	else { ?>
		<li style="slide-text-custom" >
			<a href="?module=password"><i class="fa fa-lock"></i> Cambiar contraseña</a>
		</li>
	<?php
	}
	?>
	</ul>
<?php
}
if ($_SESSION['permisos_acceso']=='Almacen') { ?>

    <ul class="sidebar-menu">
        <li style="slide-text-custom"  class="header">MENU</li>

	<?php 

  if ($_GET["module"]=="start") { ?>
    <li style="slide-text-custom"  class="active">
      <a href="?module=start"><i class="fa fa-home"></i> Inicio </a>
      </li>
  <?php
  }

  else { ?>
    <li style="slide-text-custom" >
      <a href="?module=start"><i class="fa fa-home"></i> Inicio </a>
      </li>
  <?php
  }

  if ($_GET["module"]=="productos" || $_GET["module"]=="form_productos") { ?>
    <li style="slide-text-custom"  class="active">
      <a href="?module=productos"><i class="fa fa-folder"></i> Datos de Productos </a>
      </li>
  <?php
  }
  else { ?>
    <li style="slide-text-custom" >
      <a href="?module=productos"><i class="fa fa-folder"></i> Datos de Productos </a>
      </li>
  <?php
  }

  if ($_GET["module"]=="productos_transaction" || $_GET["module"]=="form_productos_transaction") { ?>
    <li class="active">
      <a href="?module=productos_transaction"><i class="fa fa-clone"></i> Registro de Productos </a>
      </li>
  <?php
  }
  else { ?>
    <li style="slide-text-custom" >
      <a href="?module=productos_transaction"><i class="fa fa-clone"></i> Registro de Productos </a>
      </li>
  <?php
  }

  if ($_GET["module"]=="stock_inventory") { ?>
    <li style="slide-text-custom"  class="active treeview">
            <a href="javascript:void(0);">
              <i style="slide-text-custom"  class="fa fa-file-text"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
          <ul class="treeview-menu">
            <li style="slide-text-custom"  class="active"><a href="?module=stock_inventory"><i class="fa fa-circle-o"></i> Stock de Productos </a></li>
            <li style="slide-text-custom" ><a href="?module=stock_report"><i class="fa fa-circle-o"></i> Registro de Productos </a></li>
          </ul>
      </li>
    <?php
  }
  elseif ($_GET["module"]=="stock_report") { ?>
    <li  style="slide-text-custom"  class="active treeview">
            <a href="javascript:void(0);">
              <i class="fa fa-file-text"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
          <ul class="treeview-menu">
            <li style="slide-text-custom" ><a href="?module=stock_inventory"><i class="fa fa-circle-o"></i> Stock de Productos </a></li>
            <li  style="slide-text-custom" class="active"><a href="?module=stock_report"><i class="fa fa-circle-o"></i> Registro de Productos </a></li>
          </ul>
      </li>
    <?php
  }
  else { ?>
    <li style="slide-text-custom"  class="treeview">
            <a href="javascript:void(0);">
              <i  style="slide-text-custom" class="fa fa-file-text"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
          <ul class="treeview-menu">
            <li style="slide-text-custom" ><a href="?module=stock_inventory"><i class="fa fa-circle-o"></i> Stock de Productos </a></li>
            <li style="slide-text-custom" ><a href="?module=stock_report"><i class="fa fa-circle-o"></i> Registro de Productos </a></li>
          </ul>
      </li>
    <?php
  }

	if ($_GET["module"]=="password") { ?>
		<li style="slide-text-custom"  class="active">
			<a href="?module=password"><i class="fa fa-lock"></i> Cambiar contraseña</a>
		</li>
	<?php
	}
	else { ?>
		<li style="color:#fff;" >
			<a href="?module=password"><i class="fa fa-lock"></i> Cambiar contraseña</a>
		</li>
	<?php
	}
  
  ?>
	</ul>
<?php
}
?>