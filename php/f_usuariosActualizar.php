<?php
include("op_sesion.php");
include("../class/plantas.php");
include("../class/areas.php");

$usu2 = new usuarios();
$usu2->setUsu_Codigo($_POST['codigo']);
$usu2->consultar();

$pla = new plantas();
$resPla = $pla->listarPlantasUsuarioCrear("1", $_SESSION['GD_Usuario']);
?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <strong>ACTUALIZAR USUARIO</strong>
            </div>

            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#Usu_DatosAct">Usuarios</a></li>
                    <li><a data-toggle="tab" href="#UsuP_DatosAct" class="Btn_UsuPListarCrear" data-cod="<?php echo $_POST['codigo']; ?>">Plantas</a></li>
                    <li><a data-toggle="tab" href="#UsuA_DatosAct" class="Btn_UsuAListarCrear" data-cod="<?php echo $_POST['codigo']; ?>">Áreas</a></li>
                </ul>
                <div class="tab-content">
                    <div id="Usu_DatosAct" class="tab-pane fade in active">
                        <br>
                        <form id="f_usuariosActualizar" role="form">
                            <input type="hidden" id="Usu_CodigoAct" value="<?php echo $_POST['codigo']; ?>">
                            <div class="col-lg-6 col-md-6 col-sm-6">

                                <div class="form-group">
                                    <label class="control-label">Usuario:<span class="rojo">*</span></label>
                                    <input type="text" id="Usu_UsuarioAct" value="<?php echo $usu2->getUsu_Usuario(); ?>" class="form-control" maxlength="30" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Nombre:<span class="rojo">*</span></label>
                                    <input type="text" id="Usu_NombreAct" value="<?php echo $usu2->getUsu_Nombre(); ?>" class="form-control" maxlength="30" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Apellido:<span class="rojo">*</span></label>
                                    <input type="text" id="Usu_ApellidoAct" value="<?php echo $usu2->getUsu_Apellido(); ?>" class="form-control" maxlength="30" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Cargo:<span class="rojo">*</span></label>
                                    <input type="text" id="Usu_CargoAct" value="<?php echo $usu2->getUsu_Cargo(); ?>" class="form-control" maxlength="60" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Correo:<span class="rojo">*</span></label>
                                    <input type="email" id="Usu_CorreoAct" value="<?php echo $usu2->getUsu_Correo(); ?>" class="form-control" maxlength="80" required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6">

                                <div class="form-group">
                                    <label class="control-label">Teléfono:<span class="rojo">*</span></label>
                                    <input type="text" id="Usu_TelefonoAct" value="<?php echo $usu2->getUsu_Telefono(); ?>" class="form-control" maxlength="20" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Rol:<span class="rojo">*</span></label>
                                    <select id="Usu_RolAct" class="form-control" required>
                                        <option value="Usuario" <?php echo $usu2->getUsu_Rol() == "Usuario" ? "selected" : ""; ?>>Usuario</option>
                                        <option value="Usuario Compartido Planta" <?php echo $usu2->getUsu_Rol() == "Usuario Compartido Planta" ? "selected" : ""; ?>>Usuario Compartido Planta</option>
                                        <option value="Administrador" <?php echo $usu2->getUsu_Rol() == "Administrador" ? "selected" : ""; ?>>Administrador</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Planta:<span class="rojo">*</span></label>
                                    <select id="Usu_Pla_CodigoAct" class="form-control" required>
                                        <option></option>
                                        <?php foreach ($resPla as $registro) { ?>
                                            <option value="<?php echo $registro[0]; ?>" <?php echo $usu2->getPla_Codigo() == $registro[0] ? "selected" : ""; ?>><?php echo $registro[1]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Estado:</label>
                                    <select id="Usu_EstadoAct" class="form-control">
                                        <option value="1" <?php echo $usu2->getUsu_Estado() == "1" ? "selected" : ""; ?>>Activo</option>
                                        <option value="0" <?php echo $usu2->getUsu_Estado() == "0" ? "selected" : ""; ?>>Inactivo</option>
                                    </select>
                                </div>

                                <input type="hidden" value="1" id="Usu_TipoFlujoAct">

                                <div align="center">
                                    <br>
                                    <button type="submit" id="Btn_UsuariosActualizarForm" class="btn btn-success" form="f_usuariosActualizar" >Actualizar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button class="btn btn-danger e_restaurarClaveUsuarioAdmin" data-cod="<?php echo $_POST['codigo']; ?>">Restaurar Clave</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div id="UsuA_DatosAct" class="tab-pane fade">
                        <br>
                        <div class="InfoUsuA_DatosListarCrear">
                            <input type="hidden" value=" <?php echo $_POST['codigo']; ?> " id="CodigoUsuarioActualizarDef">
                        </div>
                    </div>
                    <div id="UsuP_DatosAct" class="tab-pane fade">
                        <br>
                        <div class="InfoUsuP_DatosListarCrear">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>