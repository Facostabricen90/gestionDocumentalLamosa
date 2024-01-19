<?php
include("op_sesion.php");
$pUsuarios = $usuper->Permisos($_SESSION['GD_Usuario'], 1);


$usu = new usuarios();
$resUsu = $usu->listarUsuariosPrinpal($_POST['estado'], $_POST['planta'], $_SESSION['GD_Usuario']);
?>
<div class="table-responsive">
  <table id="tbl_Usuarios" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th class="text-center" align="center">USUARIO</th>  
        <th class="text-center" align="center">PLANTA PRINCIPAL</th>  
        <th class="text-center" align="center">NOMBRE</th>  
        <th class="text-center" align="center">APELLIDO</th>  
        <th class="text-center" align="center">CARGO</th>  
        <th class="text-center" align="center">CORREO</th>  
        <th class="text-center" align="center">TELEFONO</th>  
        <th class="text-center" align="center">ROL</th>  
        <th class="text-center" align="center"></th>  
        <th class="text-center" align="center"></th>  
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resUsu as $registro){ ?>
        <tr>
          <td><?php echo $registro[1]; ?></td>  
          <td><?php echo $registro[9]; ?></td>  
          <td><?php echo $registro[2]; ?></td>  
          <td><?php echo $registro[3]; ?></td>  
          <td><?php echo $registro[4]; ?></td>  
          <td><?php echo $registro[5]; ?></td>  
          <td><?php echo $registro[6]; ?></td>  
          <td><?php echo $registro[7]; ?></td>
          <?php if(isset($pUsuarios) && $pUsuarios[4] == "1"){ ?>
            <td align="center"><button class="btn btn-warning btn-xs e_cargarUsuarios" data-cod="<?php echo $registro[0]; ?>">Editar</button></td> 
          <?php } ?>
          <td align="center"><button class="btn btn-primary btn-xs e_cargarUsuariosPermisos" data-cod="<?php echo $registro[0]; ?>" >Permisos</button></td> 
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<div class="table-responsive" style="display: none">
  <table id="tbl_UsuariosExp" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th class="text-center" align="center">USUARIO</th>  
        <th class="text-center" align="center">PLANTA PRINCIPAL</th>  
        <th class="text-center" align="center">NOMBRE</th>  
        <th class="text-center" align="center">APELLIDO</th>  
        <th class="text-center" align="center">CARGO</th>  
        <th class="text-center" align="center">CORREO</th>  
        <th class="text-center" align="center">TELEFONO</th>  
        <th class="text-center" align="center">ROL</th>  
      </tr>
    </thead>
    <tbody class="buscar">
      <?php foreach($resUsu as $registro){ ?>
        <tr>
          <td><?php echo $registro[1]; ?></td>  
          <td><?php echo $registro[9]; ?></td>  
          <td><?php echo $registro[2]; ?></td>  
          <td><?php echo $registro[3]; ?></td>  
          <td><?php echo $registro[4]; ?></td>  
          <td><?php echo $registro[5]; ?></td>  
          <td><?php echo $registro[6]; ?></td>  
          <td><?php echo $registro[7]; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>