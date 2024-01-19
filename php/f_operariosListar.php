<?php
include("op_sesion.php");
include("../class/operarios.php");

$ope = new operarios();
$resOpe = $ope->listarOperariosPrinpal($_POST['estado'], $_POST['area'], $_POST['subArea'], $_SESSION['GD_Usuario'], $_POST['planta']);
?>
<style type="text/css"> 
    thead tr th { 
        position: sticky;
        top: 0;
        z-index: 10;
        background-color: #646464;
    }

    .table-responsive { 
        height:200px;
        overflow:scroll;
    }
</style>

<div class="table-responsive" id="imp_tabla" style="width: 100%; height: 500px; overflow-y: scroll;">
    <table id="tbl_Operarios" border="1px" class="table tableEstrecha table-hover table-striped table-bordered">
        <thead>
            <tr class="ordenamiento encabezadoTab">
                <th class="text-center" align="center">NOMBRE</th>  
                <th class="text-center" align="center">PLANTA</th>  
                <th class="text-center" align="center">CÉDULA</th>  
                <th class="text-center" align="center">SEXO</th>  
                <th class="text-center" align="center">CÓD. CCOSTO</th>  
                <th class="text-center" align="center">NOM. CCOSTO</th>  
                <th class="text-center" align="center">JEFE</th>  
                <th class="text-center" align="center">CARGO</th>  
                <th class="text-center" align="center">TIPO FUNCIÓN</th>  
                <th class="text-center" align="center">ÁREA LATAM</th>  
                <th class="text-center" align="center">GERENCIA</th>  
                <th class="text-center" align="center">ÁREA</th>  
                <th class="text-center" align="center">SUBÁREA</th>  
                <th class="text-center" align="center">CORREO</th>  
                <th class="text-center" align="center">TELÉFONO</th>  
                <th class="text-center" align="center"></th>  
            </tr>
        </thead>
        <tbody class="buscar">
            <?php foreach ($resOpe as $registro) { ?>
                <tr>
                    <td nowrap><?php echo $registro[1]; ?></td>  
                    <td nowrap><?php echo $registro[15]; ?></td>  
                    <td><?php echo $registro[2]; ?></td>  
                    <td><?php echo $registro[3]; ?></td>  
                    <td><?php echo $registro[4]; ?></td>  
                    <td><?php echo $registro[5]; ?></td>  
                    <td><?php echo $registro[6]; ?></td>  
                    <td><?php echo $registro[7]; ?></td>  
                    <td><?php echo $registro[8]; ?></td>  
                    <td><?php echo $registro[9]; ?></td>  
                    <td><?php echo $registro[10]; ?></td>  
                    <td><?php echo $registro[11]; ?></td>  
                    <td><?php echo $registro[12]; ?></td>  
                    <td><?php echo $registro[13]; ?></td>  
                    <td><?php echo $registro[14]; ?></td>  
                    <td class="e_cargarOperarios" data-cod=" <?php echo $registro[0]; ?>" align="center"><button class="btn btn-warning btn-xs">Editar</button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>