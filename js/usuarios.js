$(document).ready(function (e) {

    $('#filtrar_Usuarios').keyup(function () {
        var rex = new RegExp($(this).val(), 'i');
        $('.buscar tr').hide();
        $('.buscar tr').filter(function () {
            return rex.test($(this).text());
        }).show();
    });
    $('#FiltroUsuarios_Pais').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
        selectAllText: 'Seleccionar Todos',
        nonSelectedText: 'Seleccione...',
        nSelectedText: ' Todos',
        buttonWidth: '100%',
        enableCaseInsensitiveFiltering: true,
        maxHeight: 400,
        dropUp: true
    });
    d_estado = $("#FiltroUsuarios_Estado").val();
    d_planta = $("#FiltroUsuarios_Planta").val();

    $.ajax({
        type: "POST",
        url: "f_usuariosListar.php",
        beforeSend: function () {
            $(".info_cargarUsuariosListar").html(loader());
        },
        data: {estado: d_estado, planta: d_planta},
        success: function (data) {
            $(".info_cargarUsuariosListar").html(data);
            $("#tbl_Usuarios").tablesorter();
        },
        error: function (er1, er2, er3) {
            console.log(er2 + "-" + er3);
        }
    });

    $("body").on("click", "#Btn_UsuarioBuscar", function (e) {
        e.preventDefault();
        d_estado = $("#FiltroUsuarios_Estado").val();
        d_planta = $("#FiltroUsuarios_Planta").val();

        $.ajax({
            type: "POST",
            url: "f_usuariosListar.php",
            beforeSend: function () {
                $(".info_cargarUsuariosListar").html(loader());
            },
            data: {estado: d_estado, planta: d_planta},
            success: function (data) {
                $(".info_cargarUsuariosListar").html(data);
                $("#tbl_Usuarios").tablesorter();
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });


    $("body").on("change", "#FiltroUsuarios_Pais", function (e) {
        e.preventDefault();

        d_pais = $(this).val();
        d_modulo = $(this).attr('data-mod');
        $.ajax({
            type: "POST",
            url: "f_cargarFiltroPlantas.php",
            beforeSend: function () {
                $(".e_cargarFiltroUsuarios").html(loader());
            },
            data: {d_pais: d_pais, modulo: d_modulo},
            success: function (data) {
                $(".e_cargarFiltroUsuarios").html(data);
                $('#FiltroUsuarios_Planta').multiselect({
                    enableCaseInsensitiveFiltering: true,
                    includeSelectAllOption: true,
                    enableFiltering: true,
                    selectAllText: 'Seleccionar Todos',
                    nonSelectedText: 'Seleccione...',
                    nSelectedText: ' Todos',
                    buttonWidth: '100%',
                    maxHeight: 300,
                    dropUp: true
                });
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });



    $("body").on("click", "#Btn_UsuariosCrear", function (e) {
        e.preventDefault();

        $("#vtn_UsuariosCrear").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_usuariosCrear.php",
            beforeSend: function () {
                $(".info_UsuariosCrear").html(loader());
            },
            success: function (data) {
                $(".info_UsuariosCrear").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("submit", "#f_usuariosCrear", function (e) {
        e.preventDefault();

        d_usuario = $("#f_usuariosCrear #Usu_Usuario").val();
        d_nombre = $("#f_usuariosCrear #Usu_Nombre").val();
        d_apellido = $("#f_usuariosCrear #Usu_Apellido").val();
        d_cargo = $("#f_usuariosCrear #Usu_Cargo").val();
        d_correo = $("#f_usuariosCrear #Usu_Correo").val();
        d_telefono = $("#f_usuariosCrear #Usu_Telefono").val();
        d_rol = $("#f_usuariosCrear #Usu_Rol").val();
        d_planta = $("#f_usuariosCrear #Usu_Pla_Codigo").val();
        d_tipoFlujo = $("#f_usuariosCrear #Usu_TipoFlujo").val();

        $.ajax({
            type: "POST",
            url: "op_usuariosCrear.php",
            beforeSend: function () {
                bloquearFormulario("f_usuariosCrear");
                $("#Btn_UsuariosCrearForm").hide();
            },
            complete: function () {
                desbloquearFormulario("f_usuariosCrear");
                $("#Btn_UsuariosCrearForm").show();
            },
            data: {usuario: d_usuario, nombre: d_nombre, apellido: d_apellido, cargo: d_cargo, correo: d_correo, telefono: d_telefono, rol: d_rol, planta: d_planta, tipoFlujo: d_tipoFlujo},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_UsuariosNotificacionesCrear").modal({backdrop: 'static'});
                    $(".info_UsuariosNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
                } else {
                    $("#vtn_UsuariosNotificacionesCrear").modal({backdrop: 'static'});
                    $(".info_UsuariosNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });


    $("body").on("click", "#Btn_UsuariosNotificacionesCrear", function (e) {
        e.preventDefault();

        window.location.href = "fm_usuarios.php";

    });

    $("body").on("click", ".e_cargarUsuarios", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");

        $("#vtn_UsuariosActualizar").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_usuariosActualizar.php",
            beforeSend: function () {
                $(".info_UsuariosActualizar").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_UsuariosActualizar").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("change", "#FluA_Pla_Codigo", function (e) {
        e.preventDefault();
        d_planta = $("#f_usuariosActualizar #Usu_Pla_CodigoAct").val();

        $.ajax({
            type: "POST",
            url: "f_cargarSelectAreaActualizarUsuario.php",
            data: {planta: d_planta},
            success: function (rs) {
                $("#UsuA_Are_Codigo").html(rs);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });



    $("body").on("submit", "#f_usuariosActualizar", function (e) {
        e.preventDefault();

        d_codigo = $("#f_usuariosActualizar #Usu_CodigoAct").val();
        d_usuario = $("#f_usuariosActualizar #Usu_UsuarioAct").val();
        d_nombre = $("#f_usuariosActualizar #Usu_NombreAct").val();
        d_apellido = $("#f_usuariosActualizar #Usu_ApellidoAct").val();
        d_cargo = $("#f_usuariosActualizar #Usu_CargoAct").val();
        d_correo = $("#f_usuariosActualizar #Usu_CorreoAct").val();
        d_telefono = $("#f_usuariosActualizar #Usu_TelefonoAct").val();
        d_rol = $("#f_usuariosActualizar #Usu_RolAct").val();
        d_planta = $("#f_usuariosActualizar #Usu_Pla_CodigoAct").val();
        d_estado = $("#f_usuariosActualizar #Usu_EstadoAct").val();
        d_tipoFlujo = $("#f_usuariosActualizar #Usu_TipoFlujoAct").val();

        $.ajax({
            type: "POST",
            url: "op_usuariosActualizar.php",
            beforeSend: function () {
                bloquearFormulario("f_usuariosActualizar");
                $("#Btn_UsuariosActualizarForm").hide();
            },
            complete: function () {
                desbloquearFormulario("f_usuariosActualizar");
                $("#Btn_UsuariosActualizarForm").show();
            },
            data: {codigo: d_codigo, usuario: d_usuario, nombre: d_nombre, apellido: d_apellido, cargo: d_cargo, correo: d_correo, telefono: d_telefono, rol: d_rol, planta: d_planta, estado: d_estado, tipoFlujo: d_tipoFlujo},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_UsuariosNotificacionesActualizar").modal({backdrop: 'static'});
                    $(".info_UsuariosNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
                } else {
                    $("#vtn_UsuariosNotificacionesActualizar").modal({backdrop: 'static'});
                    $(".info_UsuariosNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", "#Btn_UsuariosNotificacionesActualizar", function (e) {
        e.preventDefault();

        $("#vtn_UsuariosActualizar").modal('hide');
        $("#vtn_UsuariosNotificacionesActualizar").modal('hide');

        d_estado = $("#FiltroUsuarios_Estado").val();
        d_planta = $("#FiltroUsuarios_Planta").val();

        $.ajax({
            type: "POST",
            url: "f_usuariosListar.php",
            beforeSend: function () {
                $(".info_cargarUsuariosListar").html(loader());
            },
            data: {estado: d_estado, planta: d_planta},
            success: function (data) {
                $(".info_cargarUsuariosListar").html(data);
                $("#tbl_Usuarios").tablesorter();
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".excel_Usuarios", function (e) {
        e.preventDefault();

        d_estado = $("#FiltroUsuarios_Estado").val();

        window.location.href = "excel_usuarios.php?estado=" + d_estado + "";

    });

    $("body").on("click", ".e_cargarUsuariosPermisos", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");

        $("#vtn_UsuariosPermisos").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_usuariosPermisos.php",
            beforeSend: function () {
                $(".info_UsuariosPermisos").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_UsuariosPermisos").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });



    $("body").on("submit", "#f_usuariosPermisos", function (e) {
        e.preventDefault();

        d_codigo = $("#f_usuariosPermisos #Usu_CodigoPer").val();
        d_permiso = $("#f_usuariosPermisos #Usu_Per_CodigoPer").val();

        $.ajax({
            type: "POST",
            url: "op_usuariosPermisos.php",
            beforeSend: function () {
                bloquearFormulario("f_usuariosPermisos");
                $("#Btn_UsuariosPermisosForm").hide();
            },
            complete: function () {
                desbloquearFormulario("f_usuariosPermisos");
                $("#Btn_UsuariosPermisosForm").show();
            },
            data: {codigo: d_codigo, permiso: d_permiso},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_UsuariosNotificacionesPermisos").modal({backdrop: 'static'});
                    $(".info_UsuariosNotificacionesPermisos").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
                } else {
                    $("#vtn_UsuariosNotificacionesPermisos").modal({backdrop: 'static'});
                    $(".info_UsuariosNotificacionesPermisos").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", "#Btn_UsuariosNotificacionesPermisos", function (e) {
        e.preventDefault();

        $("#vtn_UsuariosNotificacionesPermisos").modal('hide');

        d_codigo = $("#f_usuariosPermisos #Usu_CodigoPer").val();

        $.ajax({
            type: "POST",
            url: "f_usuariosPermisos.php",
            beforeSend: function () {
                $(".info_UsuariosPermisos").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_UsuariosPermisos").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    // UsuariosAreas
    $("body").on("click", ".Btn_UsuAListarCrear", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");
        d_planta = $("#f_usuariosActualizar #Usu_Pla_CodigoAct").val();

        $.ajax({
            type: "POST",
            url: "f_usuariosAreasCrear.php",
            beforeSend: function () {
                $(".InfoUsuA_DatosListarCrear").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".InfoUsuA_DatosListarCrear").html(data);
                $.ajax({
                    type: "POST",
                    url: "f_cargarSelectAreaActualizarUsuario2.php",
                    data: {codigo: d_codigo},
                    success: function (rs) {
                        $('#UsuA_Are_Codigo').html(rs).multiselect({
                            includeSelectAllOption: true,
                            enableFiltering: true,
                            selectAllText: 'Seleccionar Todos',
                            nonSelectedText: 'Seleccione...',
                            nSelectedText: ' Todos',
                            buttonWidth: '100%',
                            enableCaseInsensitiveFiltering: true,
                            maxHeight: 400,
                            dropUp: true
                        });
                    },
                    error: function (er1, er2, er3) {
                        console.log(er2 + "-" + er3);
                    }
                });


            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("submit", "#f_usuariosAreasCrear", function (e) {
        e.preventDefault();

        d_codigo = $("#f_usuariosAreasCrear #UsuA_Usu_Codigo").val();
        d_area = $("#f_usuariosAreasCrear #UsuA_Are_Codigo").val();

        $.ajax({
            type: "POST",
            url: "op_usuariosAreasCrear.php",
            beforeSend: function () {
                bloquearFormulario("f_usuariosAreasCrear");
                $("#Btn_AgregarAreaUsuA").hide();
            },
            complete: function () {
                desbloquearFormulario("f_usuariosAreasCrear");
                $("#Btn_AgregarAreaUsuA").show();
                $(".InfoUsuA_DatosListarCrear").html(loader());
            },
            data: {codigo: d_codigo, area: d_area},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {

                    $.ajax({
                        type: "POST",
                        url: "f_usuariosAreasCrear.php",
                        beforeSend: function () {
                            $(".InfoUsuA_DatosListarCrear").html(loader());
                        },
                        data: {codigo: d_codigo},
                        success: function (data) {
                            $(".InfoUsuA_DatosListarCrear").html(data);
                            $.ajax({
                                type: "POST",
                                url: "f_cargarSelectAreaActualizarUsuario2.php",
                                data: {codigo: d_codigo},
                                success: function (rs) {
                                    $('#UsuA_Are_Codigo').html(rs).multiselect({
                                        includeSelectAllOption: true,
                                        enableFiltering: true,
                                        selectAllText: 'Seleccionar Todos',
                                        nonSelectedText: 'Seleccione...',
                                        nSelectedText: ' Todos',
                                        buttonWidth: '100%',
                                        enableCaseInsensitiveFiltering: true,
                                        maxHeight: 400,
                                        dropUp: true
                                    });
                                },
                                error: function (er1, er2, er3) {
                                    console.log(er2 + "-" + er3);
                                }
                            });
                        },
                        error: function (er1, er2, er3) {
                            console.log(er2 + "-" + er3);
                        }
                    });

                } else {
                    $("#vtn_UsuariosNotificacionesPermisos").modal({backdrop: 'static'});
                    $(".info_UsuariosNotificacionesPermisos").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("click", ".e_eliminarUsuariosAreas", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");
        d_codigoUsu = $("#f_usuariosAreasCrear #UsuA_Usu_Codigo").val();
        //d_codigoUsu = $("#f_usuariosPlantasCrear #UsuP_Usu_Codigo").val();
        $.ajax({
            type: "POST",
            url: "op_usuariosAreasEliminar.php",
            beforeSend: function () {
                bloquearFormulario("tbl_UsuariosAreas");
                $(".e_eliminarUsuariosAreas").hide();
            },
            complete: function () {
                desbloquearFormulario("tbl_UsuariosAreas");
                $(".e_eliminarUsuariosAreas").show();
                $(".InfoUsuA_DatosListarCrear").html(loader());
            },
            data: {codigo: d_codigo},
            dataType: 'json',
            success: function (rs) {

                if (rs.mensaje == "OK") {
                    $.ajax({
                        type: "POST",
                        url: "f_usuariosAreasCrear.php",
                        beforeSend: function () {
                            $(".InfoUsuA_DatosListarCrear").html(loader());
                        },
                        data: {codigo: d_codigoUsu},
                        success: function (data) {
                            $(".InfoUsuA_DatosListarCrear").html(data);
                            $.ajax({
                                type: "POST",
                                url: "f_cargarSelectAreaActualizarUsuario2.php",
                                data: {codigo: d_codigoUsu},
                                success: function (rs) {
                                    $('#UsuA_Are_Codigo').html(rs).multiselect({
                                        includeSelectAllOption: true,
                                        enableFiltering: true,
                                        selectAllText: 'Seleccionar Todos',
                                        nonSelectedText: 'Seleccione...',
                                        nSelectedText: ' Todos',
                                        buttonWidth: '100%',
                                        enableCaseInsensitiveFiltering: true,
                                        maxHeight: 400,
                                        dropUp: true
                                    });
                                },
                                error: function (er1, er2, er3) {
                                    console.log(er2 + "-" + er3);
                                }
                            });
                        },
                        error: function (er1, er2, er3) {
                            console.log(er2 + "-" + er3);
                        }
                    });
                } else {
                    $("#vtn_UsuariosNotificacionesPermisos").modal({backdrop: 'static'});
                    $(".info_UsuariosNotificacionesPermisos").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    // UsuariosPlantas
    $("body").on("click", ".Btn_UsuPListarCrear", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");


        $.ajax({
            type: "POST",
            url: "f_usuariosPlantasCrear.php",
            beforeSend: function () {
                $(".InfoUsuP_DatosListarCrear").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".InfoUsuP_DatosListarCrear").html(data);
                $('#UsuP_Pla_Codigo').multiselect({
                    includeSelectAllOption: true,
                    enableFiltering: true,
                    selectAllText: 'Seleccionar Todos',
                    nonSelectedText: 'Seleccione...',
                    nSelectedText: ' Todos',
                    buttonWidth: '100%',
                    enableCaseInsensitiveFiltering: true,
                    maxHeight: 400,
                    dropUp: true
                });

            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("submit", "#f_usuariosPlantasCrear", function (e) {
        e.preventDefault();

        d_codigo = $("#f_usuariosPlantasCrear #UsuP_Usu_Codigo").val();
        d_planta = $("#f_usuariosPlantasCrear #UsuP_Pla_Codigo").val();

        $.ajax({
            type: "POST",
            url: "op_usuariosPlantasCrear.php",
            beforeSend: function () {
                bloquearFormulario("f_usuariosPlantasCrear");
                $("#Btn_AgregarPlantasUsuP").hide();
            },
            complete: function () {
                desbloquearFormulario("f_usuariosPlantasCrear");
                $("#Btn_AgregarPlantasUsuP").show();
            },
            data: {codigo: d_codigo, planta: d_planta},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {

                    $.ajax({
                        type: "POST",
                        url: "f_usuariosPlantasCrear.php",
                        beforeSend: function () {
                            $(".InfoUsuP_DatosListarCrear").html(loader());
                            $(".e_eliminarUsuariosAreas").click();
                            $(".Btn_UsuAListarCrear").load();
                        },
                        data: {codigo: d_codigo},
                        success: function (data) {
                            $(".InfoUsuP_DatosListarCrear").html(data);
                            $('#UsuP_Pla_Codigo').multiselect({
                                includeSelectAllOption: true,
                                enableFiltering: true,
                                selectAllText: 'Seleccionar Todos',
                                nonSelectedText: 'Seleccione...',
                                nSelectedText: ' Todos',
                                buttonWidth: '100%',
                                enableCaseInsensitiveFiltering: true,
                                maxHeight: 400,
                                dropUp: true
                            });

                        },
                        error: function (er1, er2, er3) {
                            console.log(er2 + "-" + er3);
                        }
                    });

                } else {
                    $("#vtn_UsuariosNotificacionesPermisos").modal({backdrop: 'static'});
                    $(".info_UsuariosNotificacionesPermisos").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
                    mensaje('2', rs.mensaje);
                }
                $(".e_eliminarUsuariosAreas").click();
                $(".Btn_UsuAListarCrear").load();
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".e_eliminarUsuariosPlantas", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");
        d_codigoUsu = $("#f_usuariosPlantasCrear #UsuP_Usu_Codigo").val();
        $.ajax({
            type: "POST",
            url: "op_usuariosPlantasEliminar.php",
            beforeSend: function () {
                bloquearFormulario("tbl_UsuariosPlantas");
                $(".e_eliminarUsuariosPlantas").hide();
            },
            complete: function () {
                desbloquearFormulario("tbl_UsuariosPlantas");
                $(".e_eliminarUsuariosPlantas").show();
            },
            data: {codigo: d_codigo},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $.ajax({
                        type: "POST",
                        url: "f_usuariosPlantasCrear.php",
                        beforeSend: function () {
                            $(".InfoUsuP_DatosListarCrear").html(loader());
                            $(".e_eliminarUsuariosAreas").click();
                            $(".Btn_UsuAListarCrear").load();
                        },
                        data: {codigo: d_codigoUsu},
                        success: function (data) {
                            $(".InfoUsuP_DatosListarCrear").html(data);
                            $('#UsuP_Pla_Codigo').multiselect({
                                includeSelectAllOption: true,
                                enableFiltering: true,
                                selectAllText: 'Seleccionar Todos',
                                nonSelectedText: 'Seleccione...',
                                nSelectedText: ' Todos',
                                buttonWidth: '100%',
                                enableCaseInsensitiveFiltering: true,
                                maxHeight: 400,
                                dropUp: true
                            });

                        },
                        error: function (er1, er2, er3) {
                            console.log(er2 + "-" + er3);
                        }
                    });
                } else {
                    $("#vtn_UsuariosNotificacionesPermisos").modal({backdrop: 'static'});
                    $(".info_UsuariosNotificacionesPermisos").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
                    mensaje('2', rs.mensaje);
                }
                $(".e_eliminarUsuariosAreas").click();
                $(".Btn_UsuAListarCrear").load();
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("keyup", "#f_cambiarClave #clave, #f_cambiarClave #clave2", function () {
        clave = $("#f_cambiarClave #clave").val();
        clave2 = $("#f_cambiarClave #clave2").val();

        if (clave != "") {
            if (clave == clave2) {
                $("#c_clave").removeClass("has-error").addClass("has-success has-feedback");
                $("#m_clave2").removeClass("glyphicon-remove").addClass("glyphicon glyphicon-ok form-control-feedback");
            } else {
                $("#c_clave").removeClass("has-succes").addClass("has-error has-feedback");
                $("#m_clave2").removeClass("glyphicon-ok").addClass("glyphicon glyphicon-remove form-control-feedback");
            }
        }
    });

    $("body").on("submit", "#f_cambiarClave", function (e) {

        e.preventDefault();

        d_claveAct = $("#f_cambiarClave #clave_actual").val();
        d_clave2 = $("#f_cambiarClave #clave2").val();

        $.ajax({
            type: "POST",
            url: "op_cambiarClave.php",
            data: {claveAct: d_claveAct, clave2: d_clave2},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#d_mensajeCambioClave").html("Cambiado éxitosamente");
                    window.location.href = "fm_usuariosCambiarClave.php";
                } else {
                    $("#d_mensajeCambioClave").html("Error: " + rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    //Permisos Usuarios
    //Ver
    $("body").on("change", ".e_PermisoUsuActualizar1", function (e) {

        e.preventDefault();
        d_codigo = $(this).attr("data-cod");
        i = $(this).attr("data-num");

        $("body input[name='ver" + i + "']").each(function (index, element) {
            if ($(this).prop("checked") == true) {
                d_valor1 = 1;
            } else {
                d_valor1 = 0;
            }
        });
        d_valor2 = "NO";
        d_valor3 = "NO";
        d_valor4 = "NO";

        $.ajax({
            type: "POST",
            url: "op_usuarioPermisosActualizar.php",
            beforeSend: function () {
                //bloquearFormulario("f_usuarioActualizar");
            },
            complete: function () {
                //desbloquearFormulario("f_usuarioActualizar");
            },
            data: {codigo: d_codigo, valor1: d_valor1, valor2: d_valor2, valor3: d_valor3, valor4: d_valor4},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                } else {
                    mensaje('2', rs.mensaje, "#d_mensajeModalusuarioAct");
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    //Crear
    $("body").on("change", ".e_PermisoUsuActualizar2", function (e) {

        e.preventDefault();
        d_codigo = $(this).attr("data-cod");
        i = $(this).attr("data-num");

        $("body input[name='crear" + i + "']").each(function (index, element) {
            if ($(this).prop("checked") == true) {
                d_valor2 = 1;
            } else {
                d_valor2 = 0;
            }
        });
        d_valor1 = "NO";
        d_valor3 = "NO";
        d_valor4 = "NO";

        $.ajax({
            type: "POST",
            url: "op_usuarioPermisosActualizar.php",
            beforeSend: function () {
                //bloquearFormulario("f_usuarioActualizar");
            },
            complete: function () {
                //desbloquearFormulario("f_usuarioActualizar");
            },
            data: {codigo: d_codigo, valor1: d_valor1, valor2: d_valor2, valor3: d_valor3, valor4: d_valor4},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                } else {
                    mensaje('2', rs.mensaje, "#d_mensajeModalusuarioAct");
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    // Modificar
    $("body").on("change", ".e_PermisoUsuActualizar3", function (e) {

        e.preventDefault();
        d_codigo = $(this).attr("data-cod");
        i = $(this).attr("data-num");

        $("body input[name='modificar" + i + "']").each(function (index, element) {
            if ($(this).prop("checked") == true) {
                d_valor3 = 1;
            } else {
                d_valor3 = 0;
            }
        });
        d_valor2 = "NO";
        d_valor1 = "NO";
        d_valor4 = "NO";

        $.ajax({
            type: "POST",
            url: "op_usuarioPermisosActualizar.php",
            beforeSend: function () {
                //bloquearFormulario("f_usuarioActualizar");
            },
            complete: function () {
                //desbloquearFormulario("f_usuarioActualizar");
            },
            data: {codigo: d_codigo, valor1: d_valor1, valor2: d_valor2, valor3: d_valor3, valor4: d_valor4},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                } else {
                    mensaje('2', rs.mensaje, "#d_mensajeModalusuarioAct");
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    //Eliminar
    $("body").on("change", ".e_PermisoUsuActualizar4", function (e) {

        e.preventDefault();
        d_codigo = $(this).attr("data-cod");
        i = $(this).attr("data-num");

        $("body input[name='eliminar" + i + "']").each(function (index, element) {
            if ($(this).prop("checked") == true) {
                d_valor4 = 1;
            } else {
                d_valor4 = 0;
            }
        });
        d_valor2 = "NO";
        d_valor3 = "NO";
        d_valor1 = "NO";

        $.ajax({
            type: "POST",
            url: "op_usuarioPermisosActualizar.php",
            beforeSend: function () {
                //bloquearFormulario("f_usuarioActualizar");
            },
            complete: function () {
                //desbloquearFormulario("f_usuarioActualizar");
            },
            data: {codigo: d_codigo, valor1: d_valor1, valor2: d_valor2, valor3: d_valor3, valor4: d_valor4},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                } else {
                    mensaje('2', rs.mensaje, "#d_mensajeModalusuarioAct");
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("click", ".e_restaurarClaveUsuarioAdmin", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");
        d_usuario = $("#f_usuariosActualizar #Usu_UsuarioAct").val();

        $.ajax({
            type: "POST",
            url: "op_usuariosRestaurarClave.php",
            beforeSend: function () {
                $(".e_restaurarClaveUsuarioAdmin").hide();
            },
            complete: function () {
                $(".e_restaurarClaveUsuarioAdmin").show();
            },
            data: {codigo: d_codigo, usuario: d_usuario},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_UsuariosNotificacionesActualizar").modal({backdrop: 'static'});
                    $(".info_UsuariosNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Clave Restaurada Correctamente</h3>');
                } else {
                    $("#vtn_UsuariosNotificacionesActualizar").modal({backdrop: 'static'});
                    $(".info_UsuariosNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>Clave NO Restaurada Correctamente</h3>');
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("#btn_excelUsuarios").click(function (event) {
        $("#input_resultadoUsuarios").val($("<div>").append($("#tbl_UsuariosExp").eq(0).clone()).html());
        $("#f_exportarUsuarios").submit();
    });

});