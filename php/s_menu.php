<?php 
include_once("op_sesion.php"); 

$pAreas = $usuper->Permisos($_SESSION['GD_Usuario'], 4);
$pCargueDocs = $usuper->Permisos($_SESSION['GD_Usuario'], 5);
$pFlujoApro = $usuper->Permisos($_SESSION['GD_Usuario'], 6);
$pOperarios = $usuper->Permisos($_SESSION['GD_Usuario'], 7);
$pParametros = $usuper->Permisos($_SESSION['GD_Usuario'], 2);
$pPlantas = $usuper->Permisos($_SESSION['GD_Usuario'], 3);
$pPlantillasDocs = $usuper->Permisos($_SESSION['GD_Usuario'], 8);
$pUsuarios = $usuper->Permisos($_SESSION['GD_Usuario'], 1);

$pCatalogoDoc = $usuper->Permisos($_SESSION['GD_Usuario'], 9);
$pCicloDoc = $usuper->Permisos($_SESSION['GD_Usuario'], 10);
$pCicloMatriz = $usuper->Permisos($_SESSION['GD_Usuario'], 11);
$pModeloSeguridad = $usuper->Permisos($_SESSION['GD_Usuario'], 13);
$pModeloOpera = $usuper->Permisos($_SESSION['GD_Usuario'], 14);
$pProtocolosLatam = $usuper->Permisos($_SESSION['GD_Usuario'], 12);
?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a class="navbar-brand" href="f_index.php"><img src="../imagenes/Logo blan.png" width="180px"></a></div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="defaultNavbar1">
      <ul class="nav navbar-nav navbar-right">
        <?php if($usu->getUsu_Rol() == "Administrador"){ ?>
					<li class="dropdown letra18"><a href="#" class="dropdown-toggle letra18" data-toggle="dropdown" role="button" aria-expanded="false">Informes<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							
							<li><a href="fm_informesCosolidado.php">Informe Catálogo</a></li>
							<li><a href="fm_informesCosolidadoArea.php">Informe Ciclo Documental</a></li>
              
						</ul>
					</li>

				<?php } ?>
        <li><a href="f_index.php" class="letra18">Inicio</a></li>
				<?php if($usu->getUsu_Rol() == "Administrador"){ ?>
					<li class="dropdown letra18"><a href="#" class="dropdown-toggle letra18" data-toggle="dropdown" role="button" aria-expanded="false">Ingresar Información<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							
							<?php if(isset($pAreas) && $pAreas[3] == "1"){ ?>
								<li><a href="fm_areas.php">Áreas</a></li>
							<?php } ?>
              <?php if(isset($pCargueDocs) && $pCargueDocs[3] == "1"){?>
							 <li><a href="fm_cargueDocs.php">Cargue Documentos</a></li>
              <?php } ?>
              <?php if(isset($pFlujoApro) && $pFlujoApro[3] == "1"){?>
							 <li><a href="fm_flujoAprobaciones.php">Flujo de aprobaciones</a></li>
              <?php } ?>
              <?php if(isset($pOperarios) && $pOperarios[3] == "1"){?>
							 <li><a href="fm_operarios.php">Operarios</a></li>
              <?php } ?>	
              <?php if(isset($pParametros) && $pParametros[3] == "1"){?>
							 <li><a href="fm_parametros.php">Parametros</a></li>
              <?php } ?>		
              <?php if(isset($pPlantas) && $pPlantas[3] == "1"){?>
							 <li><a href="fm_plantas.php">Plantas</a></li>
              <?php } ?>			
              <?php if(isset($pPlantillasDocs) && $pPlantillasDocs[3] == "1"){?>
                <li><a href="fm_plantillasDocumentos.php">Plantillas Documentos</a></li>
              <?php } ?>			
              <?php if(isset($pUsuarios) && $pUsuarios[3] == "1"){?>
							  <li><a href="fm_usuarios.php">Usuarios</a></li>
              <?php } ?>		
              
              
						</ul>
					</li>

				<?php } ?>
                                        
                                        <?php if($usu->getUsu_Rol() != "Administrador"){ ?>
					<li class="dropdown letra18"><a href="#" class="dropdown-toggle letra18" data-toggle="dropdown" role="button" aria-expanded="false">Información<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
                <li><a href="fm_plantillasDocumentos.php">Plantillas Documentos</a></li>
						</ul>
					</li>

				<?php } ?>
        
        
        <li class="dropdown letra18"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $usu->getUsu_Nombre()." ".$usu->getUsu_Apellido(); ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="fm_usuariosCambiarClave.php">Cambiar mi clave</a></li>
            <li class="divider"></li>
            <li><a href="op_cerrarSesion.php">Cerrar Sesión</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
