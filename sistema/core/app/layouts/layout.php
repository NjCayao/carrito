<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>PLANTILLA | UNIEMPRESA</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="plugins/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/dist/css/skins/skin-blue-light.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="plugins/jquery/jquery-2.1.4.min.js"></script>
    <script src="plugins/morris/raphael-min.js"></script>
    <script src="plugins/morris/morris.js"></script>
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <link rel="stylesheet" href="plugins/morris/example.css">
    <script src="plugins/jspdf/jspdf.min.js"></script>
    <script src="plugins/jspdf/jspdf.plugin.autotable.js"></script>
    <?php if(isset($_GET["view"]) && $_GET["view"]=="sell"):?>
    <script type="text/javascript" src="plugins/jsqrcode/llqrcode.js"></script>
    <script type="text/javascript" src="plugins/jsqrcode/webqr.js"></script>
          <?php endif;?>

  </head>

  <body class="<?php if(isset($_SESSION["user_id"]) || isset($_SESSION["client_id"])):?>  skin-blue-light sidebar-mini <?php else:?>login-page<?php endif; ?>"
    style="background-image: url('storage/background.jpg'); background-size: cover;">
    <div class="wrapper">
      <!-- Main Header -->
      <?php if(isset($_SESSION["user_id"]) || isset($_SESSION["client_id"])):?>
      <header class="main-header">
        <!-- Logo -->
        <a href="./" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>G</b>F</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">SISTEMA<b>&nbsp;SERVICIOS</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

          <?php if(isset($_SESSION["user_id"])):
          $msgs = MessageData::getUnreadedByUserId($_SESSION["user_id"]); ?>
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"><?php echo count($msgs);?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tienes <?php echo count($msgs);?> mensajes nuevos</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                <?php foreach($msgs as $i):?>
                  <li><!-- start message -->
                    <a href="./?view=messages&opt=open&code=<?php echo $i->code;?>">
                      <h4>
                    <?php if($i->user_from!=$_SESSION["user_id"]):?>
                    <?php $u = $i->getFrom(); echo $u->name." ".$u->lastname;?>
                    <?php elseif($i->user_to!=$_SESSION["user_id"]):?>
                    <?php $u = $i->getTo(); echo $u->name." ".$u->lastname;?>
                  <?php endif; ?>
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>

                      </h4>
                      <p><?php echo $i->message; ?></p>
                    </a>
                  </li>
                <?php endforeach; ?>

                </ul>
              </li>
              <li class="footer"><a href="./?view=messages&opt=all">Todos los mensajes</a></li>
            </ul>
          </li>
          <?php endif;?>
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class=""><?php if(isset($_SESSION["user_id"]) ){ echo UserData::getById($_SESSION["user_id"])->name;
                  if(Core::$user->kind==1){ echo " (Administrador)"; }
                  else if(Core::$user->kind==2);
                  else if(Core::$user->kind==3); 
                  }else if (isset($_SESSION["client_id"])){ echo PersonData::getById($_SESSION["client_id"])->name." (Cliente)" ;}?> <b class="caret"></b> </span>
                </a>
                <ul class="dropdown-menu">
              <li class="user-header">
                <?php if(Core::$user->image!=""){
                $url = "storage/profiles/".Core::$user->image;
                if(file_exists($url)){
                  echo "<img src='$url' class='img-circle'>";
                } } ?>
                <p>
                <?php echo Core::$user->name." ".Core::$user->lastname;?>
                </p>
              </li>                  <!-- The user image in the menu -->
                  <!--<li><a href="">Cambiar de usuario</a></li>-->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="./?view=profile" class="btn btn-default btn-flat">Mi Perfil</a>
                      <a href="./logout.php" class="btn btn-default btn-flat">Salir</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">ADMINISTRACION</li>
            <?php if(isset($_SESSION["user_id"])):?>
            <li><a href="./index.php?view=home"><i class='fa fa-dashboard'></i> <span>Resumen</span></a></li>
            <?php if(Core::$user->kind==1||Core::$user->kind==2):?>
            <li><a href="./index.php?view=alerts"><i class='fa fa-bell-o'></i> <span>Alertas</span></a></li>
            <li><a href="./?view=fotos"><i class='fa fa-bell-o'></i> <span>Subir fotos</span></a></li>
            <li><a href="./?view=clients" ><i class='fa fa-users'></i><span>Clientes</span></a></li>
            <li><a href="./?view=providers"><i class="fa fa-truck"></i> <span> Proveedores</span></a></li>
            <li><a href="./?view=categories"><i class="fa fa-list-ol"></i> <span> Categorías</span></a></li>
            <li><a href="./?view=products" ><i class='fa fa-glass'></i><span>Productos</span></a></li>
            <li><a href="./?view=spends" ><i class='fa fa-coffee'></i> <span> Gastos</span></a></li>
            <li><a href="./?view=mapa" ><i class='fa fa-map-marker'></i> <span> Mapa</span></a></li>
            <?php endif; ?>
            <?php if(Core::$user->kind==1 || Core::$user->kind==2):?>
            <?php if(Core::$user->kind==1):?>
            <li class="treeview">
              <a href="#"><i class='fa fa-wrench'></i> <span>Administracion</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="./?view=stocks"><i class='fa fa-building-o'></i> Sucursales</a></li>
                <li><a href="./?view=users"><i class='fa fa-users'></i> Usuarios</a></li>
                <li><a href="./?view=configurations"><i class='fa fa-cog'></i> Configuracion</a></li>
              </ul>
            </li>
          <?php endif; ?>
          <?php endif; ?>
            <?php elseif(isset($_SESSION["client_id"])):?>
          <?php endif;?>
          </ul><!-- /.sidebar-menu -->
        </section><!-- /.sidebar -->
      </aside>
    <?php endif;?>

      <!-- Content Wrapper. Contains page content -->
      <?php if(isset($_SESSION["user_id"]) || isset($_SESSION["client_id"])):?>
      <div class="content-wrapper">
        <?php View::load("index");?>
      </div><!-- /.content-wrapper -->

        <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 7.2
        </div>
        <strong>Copyright &copy; 2020 <a href="http://sergestec.com/" target="_blank">Sergestec</a></strong>
      </footer>
      <?php else:?>
        <?php if(isset($_GET["view"]) && $_GET["view"]=="clientaccess"):?>
    <div class="login-box">
      <div class="login-logo">
        <a href="./"><b>PV MULTISUCURSAL</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
      <center><h4>Cliente</h4></center>
        <form action="./?action=processloginclient" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="username" required class="form-control" placeholder="Usuario"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" required class="form-control" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">

            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Acceder</button>
              <a href="./" class="btn btn-default btn-block btn-flat"><i class="fa fa-arrow-left"></i> Regresar</a>
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
        <?php else:?>
    <div class="login-box" >
      <div class="login-logo">
        <a href="./"><b>&nbsp;</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body" >
      <center><h2><a href="/">SISTEMA ADMINISTRADOR DE ...</a></h2></center>&nbsp;
        <form action="./?action=processlogin" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="username" required class="form-control" value="admin" />
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" required class="form-control" value="1234" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">

            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Acceder</button>
              <!--
              <a href="./?view=clientaccess" class="btn btn-default btn-block btn-flat">Acceso al cliente <i class="fa fa-arrow-right"></i> </a>-->
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
      <?php endif;?>
      <?php endif;?>


    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <!-- Bootstrap 3.3.2 JS -->
    <script src="plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="plugins/dist/js/app.min.js" type="text/javascript"></script>

    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $(".datatable").DataTable({
          "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
        });
      });
    </script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
          Both of these plugins are recommended to enhance the
          user experience. Slimscroll is required when using the
          fixed layout. -->
  </body>
</html>

