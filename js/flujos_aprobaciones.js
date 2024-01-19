$(document).ready(function (e) {

    $('#filtrar_FlujosAprobaciones').keyup(function () {
        var rex = new RegExp($(this).val(), 'i');
        $('.buscar tr').hide();
        $('.buscar tr').filter(function () {
            return rex.test($(this).text());
        }).show();
    });

    $('#FiltroFluA_Pais').multiselect({
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

    $('#FiltroUsuario').multiselect({
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



    d_planta = $("#FiltroFluA_Planta").val();

    d_estado = $("#FiltroOperarios_Estado").val();
    d_area = $("#FiltroAreaNombres").val();
    d_usuario = $("#FiltroUsuario").val();
    d_tipoFlujo = $("#FiltroOperarios_TipoFlujo").val();

    $.ajax({
        type: "POST",
        url: "f_flujosAprobacionesListar.php",
        beforeSend: function () {
            $(".info_cargarFlujosAprobacionesListar").html(loader());
        },
        data: {estado: d_estado, area: d_area, usuario: d_usuario, tipoFlujo: d_tipoFlujo, planta: d_planta},
        success: function (data) {
            $(".info_cargarFlujosAprobacionesListar").html(data);
            $("#tbl_FlujosAprobaciones").tablesorter();
        },
        error: function (er1, er2, er3) {
            console.log(er2 + "-" + er3);
        }
    });

    $("body").on("click", "#Btn_FluABuscar", function (e) {
        e.preventDefault();
        d_planta = $("#FiltroFluA_Planta").val();

        d_estado = $("#FiltroOperarios_Estado").val();
        d_area = $("#FiltroAreaNombres").val();
        d_usuario = $("#FiltroUsuario").val();
        d_tipoFlujo = $("#FiltroOperarios_TipoFlujo").val();

        $.ajax({
            type: "POST",
            url: "f_flujosAprobacionesListar.php",
            beforeSend: function () {
                $(".info_cargarFlujosAprobacionesListar").html(loader());
            },
            data: {estado: d_estado, area: d_area, usuario: d_usuario, tipoFlujo: d_tipoFlujo, planta: d_planta},
            success: function (data) {
                $(".info_cargarFlujosAprobacionesListar").html(data);
                $("#tbl_FlujosAprobaciones").tablesorter();
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });


    $("body").on("change", "#FiltroFluA_Pais", function (e) {
        e.preventDefault();

        d_pais = $(this).val();
        d_modulo = $(this).attr('data-mod');
        $.ajax({
            type: "POST",
            url: "f_cargarFiltroPlantas.php",
            beforeSend: function () {
                $(".e_cargarFiltroFluAPlantas").html(loader());
            },
            data: {d_pais: d_pais, modulo: d_modulo},
            success: function (data) {
                $(".e_cargarFiltroFluAPlantas").html(data);
                $('#FiltroFluA_Planta').multiselect({
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

    $("body").on("click", "#Btn_FlujosAprobacionesCrear", function (e) {
        e.preventDefault();

        $("#vtn_FlujosAprobacionesCrear").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_flujosAprobacionesCrear.php",
            beforeSend: function () {
                $(".info_FlujosAprobacionesCrear").html(loader());
            },
            success: function (data) {
                $(".info_FlujosAprobacionesCrear").html(data);
                $('#Usu_Usu_Codigo').multiselect({
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

    $("body").on("submit", "#f_flujosAprobacionesCrear", function (e) {
        e.preventDefault();

        d_usuario = $("#f_flujosAprobacionesCrear #Usu_Usu_Codigo").val();
        d_area = $("#f_flujosAprobacionesCrear #Usu_Are_Codigo").val();
        d_paso = $("#f_flujosAprobacionesCrear #FluA_Paso").val();
        d_tipoFlujo = $("#f_flujosAprobacionesCrear #FluA_TipoFlujo").val();
        d_planta = $("#f_flujosAprobacionesCrear #FluA_Pla_Codigo").val();

        $.ajax({
            type: "POST",
            url: "op_flujosAprobacionesCrear.php",
            beforeSend: function () {
                bloquearFormulario("f_flujosAprobacionesCrear");
                $("#Btn_FlujosAprobacionesCrearForm").hide();
            },
            complete: function () {
                desbloquearFormulario("f_flujosAprobacionesCrear");
                $("#Btn_FlujosAprobacionesCrearForm").show();
            },
            data: {usuario: d_usuario, area: d_area, paso: d_paso, tipoFlujo: d_tipoFlujo, planta: d_planta},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_FlujosAprobacionesNotificacionesCrear").modal({backdrop: 'static'});
                    $(".info_FlujosAprobacionesNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
                } else {
                    $("#vtn_FlujosAprobacionesNotificacionesCrear").modal({backdrop: 'static'});
                    $(".info_FlujosAprobacionesNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });
    
    $("body").on("change", "#FluA_Pla_Codigo", function (e) {
        e.preventDefault();
        d_planta = $("#f_flujosAprobacionesCrear #FluA_Pla_Codigo").val();

        $.ajax({
            type: "POST",
            url: "f_cargarSelectArea.php",
            data: {planta: d_planta},
            success: function (rs) {
               $("#Usu_Are_Codigo").html(rs);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", "#Btn_FlujosAprobacionesNotificacionesCrear", function (e) {
        e.preventDefault();

        $("#vtn_FlujosAprobacionesNotificacionesCrear").modal('hide');
        $("#vtn_FlujosAprobacionesCrear").modal('hide');

        d_estado = $("#FiltroOperarios_Estado").val();
        d_area = $("#FiltroArea").val();
        d_usuario = $("#FiltroUsuario").val();
        d_tipoFlujo = $("#FiltroOperarios_TipoFlujo").val();

        $.ajax({
            type: "POST",
            url: "f_flujosAprobacionesListar.php",
            beforeSend: function () {
                $(".info_cargarFlujosAprobacionesListar").html(loader());
            },
            data: {estado: d_estado, area: d_area, usuario: d_usuario, tipoFlujo: d_tipoFlujo},
            success: function (data) {
                $(".info_cargarFlujosAprobacionesListar").html(data);
                $("#tbl_FlujosAprobaciones").tablesorter();
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });


    $("#vtn_FlujosAprobacionesActualizar").on("change", "#FluA_Pla_CodigoAct", function (e) {
        areasPlantaListar();
    });
    $("body").on("click", ".e_cargarFlujosAprobaciones", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");

        $("#vtn_FlujosAprobacionesActualizar").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_flujosAprobacionesActualizar.php",
            beforeSend: function () {
                $(".info_FlujosAprobacionesActualizar").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_FlujosAprobacionesActualizar").html(data);
                areasPlantaListar();
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("submit", "#f_flujosAprobacionesActualizar", function (e) {
        e.preventDefault();

        d_codigo = $("#f_flujosAprobacionesActualizar #FluA_CodigoAct").val();
        d_usuario = $("#f_flujosAprobacionesActualizar #Usu_CodigoAct").val();
        d_area = $("#f_flujosAprobacionesActualizar #Area_CodigoAct").val();
        d_paso = $("#f_flujosAprobacionesActualizar #FluA_PasoAct").val();
        d_estado = $("#f_flujosAprobacionesActualizar #FluA_EstadoAct").val();
        d_tipoFlujo = $("#f_flujosAprobacionesActualizar #FluA_TipoFlujoAct").val();
        d_planta = $("#f_flujosAprobacionesActualizar #FluA_Pla_CodigoAct").val();
        d_responsable = $("#f_flujosAprobacionesActualizar #FluA_ResponsableAct").val();

        $.ajax({
            type: "POST",
            url: "op_flujosAprobacionesActualizar.php",
            beforeSend: function () {
                bloquearFormulario("f_flujosAprobacionesActualizar");
                $("#Btn_FlujosAprobacionesActualizarForm").hide();
            },
            complete: function () {
                desbloquearFormulario("f_flujosAprobacionesActualizar");
                $("#Btn_FlujosAprobacionesActualizarForm").show();
            },
            data: {codigo: d_codigo, usuario: d_usuario, area: d_area, paso: d_paso, estado: d_estado, tipoFlujo: d_tipoFlujo, planta: d_planta, responsable: d_responsable},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_FlujosAprobacionesNotificacionesActualizar").modal({backdrop: 'static'});
                    $(".info_FlujosAprobacionesNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
                } else {
                    $("#vtn_FlujosAprobacionesNotificacionesActualizar").modal({backdrop: 'static'});
                    $(".info_FlujosAprobacionesNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", "#Btn_FlujosAprobacionesNotificacionesActualizar", function (e) {
        e.preventDefault();

        $("#vtn_FlujosAprobacionesNotificacionesActualizar").modal('hide');
        $("#vtn_FlujosAprobacionesActualizar").modal('hide');

        d_estado = $("#FiltroOperarios_Estado").val();
        d_area = $("#FiltroArea").val();
        d_usuario = $("#FiltroUsuario").val();
        d_tipoFlujo = $("#FiltroOperarios_TipoFlujo").val();

        $.ajax({
            type: "POST",
            url: "f_flujosAprobacionesListar.php",
            beforeSend: function () {
                $(".info_cargarFlujosAprobacionesListar").html(loader());
            },
            data: {estado: d_estado, area: d_area, usuario: d_usuario, tipoFlujo: d_tipoFlujo},
            success: function (data) {
                $(".info_cargarFlujosAprobacionesListar").html(data);
                $("#tbl_FlujosAprobaciones").tablesorter();
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("change", "#f_flujosAprobacionesCrear #FluA_TipoFlujo", function (e) {
        e.preventDefault();

        d_tipoFlujo = $("#f_flujosAprobacionesCrear #FluA_TipoFlujo").val();

        $.ajax({
            type: "POST",
            url: "f_pasosTipoFlujoAprobacionesCrear.php",
            beforeSend: function () {
            },
            data: {tipoFlujo: d_tipoFlujo},
            success: function (data) {
                $(".info_CargarPasoTipoFlujoCrearAdmin").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("change", "#f_flujosAprobacionesActualizar #FluA_TipoFlujoAct", function (e) {
        e.preventDefault();

        d_tipoFlujo = $("#f_flujosAprobacionesActualizar #FluA_TipoFlujoAct").val();

        $.ajax({
            type: "POST",
            url: "f_pasosTipoFlujoAprobacionesActualizar.php",
            beforeSend: function () {
            },
            data: {tipoFlujo: d_tipoFlujo},
            success: function (data) {
                $(".info_CargarPasoTipoFlujoCrearAdminAct").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

});
function areasPlantaListar() {
    d_planta = $("#FluA_Pla_CodigoAct").val();
    d_flujo = $("#FluA_CodigoAct").val();
    $.ajax({
        type: "POST",
        url: "f_areaPlantasOpcionListar.php",
        beforeSend: function () {
        },
        data: {
            planta: d_planta,
            flujo: d_flujo
        },
        success: function (rs) {
            $("#Area_CodigoAct").html(rs);
        },
        error: function (er1, er2, er3) {
            console.log(er2 + "-" + er3);
        }
    });
}