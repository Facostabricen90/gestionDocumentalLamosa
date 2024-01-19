<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Usuarios.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<?php
include("op_sesion.php");

$usu = new usuarios();
$resUsu = $usu->listarUsuariosPrinpal($_GET['estado']);
?>
<meta charset="utf-8">

<h3 align="center">Usuarios</h3>
<br>



<div class="table-responsive">
  <table id="tbl_Usuarios" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th class="text-center" align="center">USUARIO</th>  
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