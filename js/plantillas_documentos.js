$(document).ready(function (e) {
    listarPlantillas();
    $('#filtrarPlantillasDocumentos').keyup(function () {
        var rex = new RegExp($(this).val(), 'i');
        $('.buscar tr').hide();
        $('.buscar tr').filter(function () {
            return rex.test($(this).text());
        }).show();
    });
    $('#planta_codigoFiltro').change(function () {
         $("#listarPlantillas").html('');
        listarPlantillas();
    });

    $("body").on("click", "#Btn_PlantillasDocumentosCrear", function (e) {
        e.preventDefault();

        $("#vtn_PlantillasDocumentosCrear").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_plantillasDocumentosCrear.php",
            beforeSend: function () {
                $(".info_PlantillasDocumentosCrear").html(loader());
            },
            success: function (data) {
                $(".info_PlantillasDocumentosCrear").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("submit", "#f_plantillasDocumentosCrear", function (e) {
        e.preventDefault();

        d_tipoDocumento = $("#f_plantillasDocumentosCrear #PlaD_Tipo").val();
        d_ano = $("#f_plantillasDocumentosCrear #PlaD_Ano").val();
        d_mes = $("#f_plantillasDocumentosCrear #PlaD_Mes").val();
        d_archivo = $("#f_plantillasDocumentosCrear #i_PlaD_Plantilla").val();
        d_planta_codigo = $("#f_plantillasDocumentosCrear #planta_codigo").val();

        $.ajax({
            type: "POST",
            url: "op_plantillasDocumentosCrear.php",
            beforeSend: function () {
                bloquearFormulario("f_plantillasDocumentosCrear");
                $("#Btn_PlantillasDocumentosCrearForm").hide();
            },
            complete: function () {
                desbloquearFormulario("f_plantillasDocumentosCrear");
                $("#Btn_PlantillasDocumentosCrearForm").show();
            },
            data: {tipoDocumento: d_tipoDocumento, ano: d_ano, mes: d_mes, archivo: d_archivo, planta_codigo: d_planta_codigo},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_PlantillasDocumentosNotificaciones").modal({backdrop: 'static'});
                    $(".info_PlantillasDocumentosNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
                } else {
                    $("#vtn_PlantillasDocumentosNotificaciones").modal({backdrop: 'static'});
                    $(".info_PlantillasDocumentosNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
                    $("#Btn_PlantillasDocumentosCrearForm").show();
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".e_cargarPlantillasDocumentos", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");

        $("#vtn_PlantillasDocumentosActualizar").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_plantillasDocumentosActualizar.php",
            beforeSend: function () {
                $(".info_PlantillasDocumentosActualizar").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_PlantillasDocumentosActualizar").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("submit", "#f_plantillasDocumentosActualizar", function (e) {
        e.preventDefault();

        d_codigo = $("#f_plantillasDocumentosActualizar #PlaD_CodigoAct").val();
        d_tipoDocumento = $("#f_plantillasDocumentosActualizar #PlaD_TipoAct").val();
        d_ano = $("#f_plantillasDocumentosActualizar #PlaD_AnoAct").val();
        d_mes = $("#f_plantillasDocumentosActualizar #PlaD_MesAct").val();
        d_archivo = $("#f_plantillasDocumentosActualizar #i_PlaD_PlantillaAct").val();
        d_estado = $("#f_plantillasDocumentosActualizar #PlaD_EstadoAct").val();

        $.ajax({
            type: "POST",
            url: "op_plantillasDocumentosActualizar.php",
            beforeSend: function () {
                bloquearFormulario("f_plantillasDocumentosActualizar");
                $("#Btn_PlantillasDocumentosActualizarForm").hide();
            },
            complete: function () {
                desbloquearFormulario("f_plantillasDocumentosActualizar");
                $("#Btn_PlantillasDocumentosActualizarForm").show();
            },
            data: {codigo: d_codigo, tipoDocumento: d_tipoDocumento, ano: d_ano, mes: d_mes, archivo: d_archivo, estado: d_estado},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_PlantillasDocumentosNotificaciones").modal({backdrop: 'static'});
                    $(".info_PlantillasDocumentosNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
                } else {
                    $("#vtn_PlantillasDocumentosNotificaciones").modal({backdrop: 'static'});
                    $(".info_PlantillasDocumentosNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
                    $("#Btn_PlantillasDocumentosCrearForm").show();
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", "#Btn_PlantillasDocumentosNotificaciones", function (e) {
        e.preventDefault();

        window.location.href = "fm_plantillasDocumentos.php";

    });

    $("body").on("click", "#Btn_CargueDocumentosCrear", function (e) {
        e.preventDefault();

        $("#vtn_CargueDocumentosCrear").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_cargueDocumentosCrear.php",
            beforeSend: function () {
                $(".info_CargueDocumentosCrear").html(loader());
            },
            success: function (data) {
                $(".info_CargueDocumentosCrear").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("submit", "#f_cargueDocumentosCrear", function (e) {
        e.preventDefault();
        d_tipoDocumento = $("#f_cargueDocumentosCrear #Car_TipoDocumento").val();
        d_codigo = $("#f_cargueDocumentosCrear #Car_Codigo").val();
        d_nombre = $("#f_cargueDocumentosCrear #Car_Nombre").val();
        d_version = $("#f_cargueDocumentosCrear #Car_Version").val();
        d_area = $("#f_cargueDocumentosCrear #Car_Area").val();
        d_usuario = $("#f_cargueDocumentosCrear #Car_Usu").val();
        d_observacion = $("#f_cargueDocumentosCrear #Car_Observacion").val();
        d_archivo = $("#f_cargueDocumentosCrear #i_Car_SubirArchivo").val();

        $.ajax({
            type: "POST",
            url: "op_cargeDocumentosCrear.php",
            beforeSend: function () {
                bloquearFormulario("f_cargueDocumentosCrear");
                $("#Btn_CargueDocumentosCrearForm").hide();
            },
            complete: function () {
                desbloquearFormulario("f_cargueDocumentosCrear");
                $("#Btn_CargueDocumentosCrearForm").show();
            },
            data: {tipoDocumento: d_tipoDocumento, codigo: d_codigo, nombre: d_nombre, version: d_version, area: d_area, usuario: d_usuario, observacion: d_observacion, archivo: d_archivo},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_CargueDocumentosNotificaciones").modal({backdrop: 'static'});
                    $(".info_CargueDocumentosNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
                } else {
                    $("#vtn_CargueDocumentosNotificaciones").modal({backdrop: 'static'});
                    $(".info_CargueDocumentosNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
                    $("#Btn_CargueDocumentosCrearForm").show();
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("click", "#Btn_CargueDocumentosNotificaciones", function (e) {
        e.preventDefault();

        window.location.href = "fm_cargueDocs.php";

    });

});
function listarPlantillas() {
    d_planta = $("#planta_codigoFiltro").val();
    $.ajax({
        url: "f_plantillaDocumentoListar.php",
        type: "POST",
        beforeSend: function () {
            loader("#listarPlantillas");
        },
        data: {
            planta: d_planta
        },
        success: function (rs) {
            $("#listarPlantillas").html(rs);
        },
        error: function (er1, er2, er3) {
            console.log(er1);
            console.log(er2);
            console.log(er3);
        }
    });
}