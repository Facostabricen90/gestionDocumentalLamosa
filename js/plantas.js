$(document).ready(function (e) {

    $('#filtrar_Plantas').keyup(function () {
        var rex = new RegExp($(this).val(), 'i');
        $('.buscar tr').hide();
        $('.buscar tr').filter(function () {
            return rex.test($(this).text());
        }).show();
    });

    d_estado = $("#FiltroPlantas_Estado").val();

    $.ajax({
        type: "POST",
        url: "f_plantasListar.php",
        beforeSend: function () {
            $(".info_cargarPlantasListar").html(loader());
        },
        data: {estado: d_estado},
        success: function (data) {
            $(".info_cargarPlantasListar").html(data);
            $("#tbl_Plantas").tablesorter();
        },
        error: function (er1, er2, er3) {
            console.log(er2 + "-" + er3);
        }
    });

    $("body").on("change", "#FiltroPlantas_Estado", function (e) {
        e.preventDefault();

        d_estado = $("#FiltroPlantas_Estado").val();

        $.ajax({
            type: "POST",
            url: "f_plantasListar.php",
            beforeSend: function () {
                $(".info_cargarPlantasListar").html(loader());
            },
            data: {estado: d_estado},
            success: function (data) {
                $(".info_cargarPlantasListar").html(data);
                $("#tbl_Plantas").tablesorter();
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", "#Btn_PlantasCrear", function (e) {
        e.preventDefault();

        $("#vtn_PlantasCrear").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_plantasCrear.php",
            beforeSend: function () {
                $(".info_PlantasCrear").html(loader());
            },
            success: function (data) {
                $(".info_PlantasCrear").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });


    $("body").on("submit", "#f_plantasCrear", function (e) {
        e.preventDefault();

        d_grupo = $("#f_plantasCrear #Pla_Grupo").val();
        d_negocio = $("#f_plantasCrear #Pla_Negocio").val();
        d_distribucion = $("#f_plantasCrear #Pla_Distribucion").val();
        d_marca = $("#f_plantasCrear #Pla_Marca").val();
        d_nombre = $("#f_plantasCrear #Pla_Nombre").val();

        $.ajax({
            type: "POST",
            url: "op_plantasCrear.php",
            beforeSend: function () {
                bloquearFormulario("f_plantasCrear");
                $("#Btn_PlantasCrearForm").hide();
            },
            complete: function () {
                desbloquearFormulario("f_plantasCrear");
                $("#Btn_PlantasCrearForm").show();
            },
            data: {grupo: d_grupo, negocio: d_negocio, distribucion: d_distribucion, marca: d_marca, nombre: d_nombre},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_PlantasNotificacionesCrear").modal({backdrop: 'static'});
                    $(".info_PlantasNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
                } else {
                    $("#vtn_PlantasNotificacionesCrear").modal({backdrop: 'static'});
                    $(".info_PlantasNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });


    $("body").on("click", "#Btn_PlantasNotificacionesCrear", function (e) {
        e.preventDefault();

        window.location.href = "fm_plantas.php";

    });

    $("body").on("click", ".e_cargarPlantas", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");

        $("#vtn_PlantasActualizar").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_plantasActualizar.php",
            beforeSend: function () {
                $(".info_PlantasActualizar").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_PlantasActualizar").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("submit", "#f_plantasActualizar", function (e) {
        e.preventDefault();

        d_codigo = $("#f_plantasActualizar #Pla_CodigoAct").val();
        d_nombre = $("#f_plantasActualizar #Pla_NombreAct").val();
        d_estado = $("#f_plantasActualizar #Pla_EstadoAct").val();

        $.ajax({
            type: "POST",
            url: "op_plantasActualizar.php",
            beforeSend: function () {
                bloquearFormulario("f_plantasActualizar");
                $("#Btn_PlantasActualizarForm").hide();
            },
            complete: function () {
                desbloquearFormulario("f_plantasActualizar");
                $("#Btn_PlantasActualizarForm").show();
            },
            data: {codigo: d_codigo, nombre: d_nombre, estado: d_estado},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_PlantasNotificacionesActualizar").modal({backdrop: 'static'});
                    $(".info_PlantasNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
                } else {
                    $("#vtn_PlantasNotificacionesActualizar").modal({backdrop: 'static'});
                    $(".info_PlantasNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", "#Btn_PlantasNotificacionesActualizar", function (e) {
        e.preventDefault();

        $("#vtn_PlantasActualizar").modal('hide');
        $("#vtn_PlantasNotificacionesActualizar").modal('hide');

        d_estado = $("#FiltroPlantas_Estado").val();

        $.ajax({
            type: "POST",
            url: "f_plantasListar.php",
            beforeSend: function () {
                $(".info_cargarPlantasListar").html(loader());
            },
            data: {estado: d_estado},
            success: function (data) {
                $(".info_cargarPlantasListar").html(data);
                $("#tbl_Plantas").tablesorter();
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".excel_Plantas", function (e) {
        e.preventDefault();

        d_estado = $("#FiltroPlantas_Estado").val();

        window.location.href = "excel_plantas.php?estado=" + d_estado + "";

    });

    // CATALOGO DOCUMENTOS


    $('#filtrar_Catalogo').keyup(function () {
        var rex = new RegExp($(this).val(), 'i');
        $('.buscar tr').hide();
        $('.buscar tr').filter(function () {
            return rex.test($(this).text());
        }).show();
    });


    $('#FiltroCatDoc_Pais').multiselect({
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
    d_planta = $("#FiltroCatDoc_Planta").val();

    d_area = $("#Cat_Area_Codigo").val();
    d_tipo = $("#Cat_TipoDocumento").val();
    $.ajax({
        type: "POST",
        url: "f_catalogoDocumentosListar.php",
        beforeSend: function () {
            $(".info_catalogoDocumentosListar").html(loader());
        },
        data: {area: d_area, tipo: d_tipo, planta: d_planta},
        success: function (data) {
            $(".info_catalogoDocumentosListar").html(data);
            $("#tbl_catalogoDocumentos").tablesorter();
        },
        error: function (er1, er2, er3) {
            console.log(er2 + "-" + er3);
        }
    });

    $("body").on("click", "#Btn_CatDocsBuscar", function (e) {
        e.preventDefault();
        d_planta = $("#FiltroCatDoc_Planta").val();

        d_area = $("#Cat_Area_Codigocater").val();
        d_tipo = $("#Cat_TipoDocumento").val();
        $.ajax({
            type: "POST",
            url: "f_catalogoDocumentosListar.php",
            beforeSend: function () {
                $(".info_catalogoDocumentosListar").html(loader());
            },
            data: {area: d_area, tipo: d_tipo, planta: d_planta},
            success: function (data) {
                $(".info_catalogoDocumentosListar").html(data);
                $("#tbl_catalogoDocumentos").tablesorter();
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("change", "#FiltroCatDoc_Pais", function (e) {
        e.preventDefault();
        d_pais = $(this).val();
        d_modulo = $(this).attr('data-mod');
        $.ajax({
            type: "POST",
            url: "f_cargarFiltroPlantas.php",
            beforeSend: function () {
                $(".e_cargarFiltroCatDocPlantas").html(loader());
            },
            data: {d_pais: d_pais, modulo: d_modulo},
            success: function (data) {
                $(".e_cargarFiltroCatDocPlantas").html(data);
                $('#FiltroCatDoc_Planta').multiselect({
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

    $("body").on("click", ".e_cargarCatalogo", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");

        $("#vtn_VerCatalogo").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_verCatalogo.php",
            beforeSend: function () {
                $(".info_VerCatalogo").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_VerCatalogo").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("#btn_excelCatalogo").click(function (event) {
        $("#input_resultadoCatalogo").val($("<div>").append($("#tbl_catalogoDocumentosExp").eq(0).clone()).html());
        $("#f_exportarCatalogo").submit();
    });

    $("#btn_excelCatalogoVer").click(function (event) {
        $("#input_resultadoCatalogoVer").val($("<div>").append($("#tbl_catalogoDocumentosExpVer").eq(0).clone()).html());
        $("#f_exportarCatalogoVer").submit();
    });


    $("body").on("click", ".e_cargarHistorial", function (e) {
        e.preventDefault();

        d_codigoHis = $(this).attr("data-codHis");

        $("#vtn_HistorialCatalogo").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_historialCatalogo.php",
            beforeSend: function () {
                $(".info_HistorialCatalogo").html(loader());
            },
            data: {code: d_codigoHis},
            success: function (data) {
                $(".info_HistorialCatalogo").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("click", ".excel_HistorialCatalogo", function (e) {
        e.preventDefault();

        d_code = $("#HistorialCatalogoId").val();

        window.location.href = "excel_HistorialCatalogo.php?code=" + d_code + "";

    });

    $("body").on("click", ".e_cargarSolicitudGestionAdminAct", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");

        $("#vtn_SolicitudesAdmActualizar").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_solicitudesAdminActualizar.php",
            beforeSend: function () {
                $(".info_SolicitudesAdmActualizar").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_SolicitudesAdmActualizar").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("submit", "#f_solicitudesAdminActualizar", function (e) {
        e.preventDefault();

        d_codigo = $("#f_solicitudesAdminActualizar #SolAdm_Codigo").val();
        d_usuario = $("#f_solicitudesAdminActualizar #SolAdm_Usu_Codigo").val();
        d_area = $("#f_solicitudesAdminActualizar #SolAdm_Area_Codigo").val();
        d_codigoRadicado = $("#f_solicitudesAdminActualizar #SolAdm_CodigoRadicado").val();
        d_codigoDocumento = $("#f_solicitudesAdminActualizar #SolAdm_CodigoDocumento").val();
        d_nombreDocumento = $("#f_solicitudesAdminActualizar #SolAdm_NombreDocumento").val();
        d_historialVersion = $("#f_solicitudesAdminActualizar #SolAdm_HistorialVersion").val();
        d_accionDocumento = $("#f_solicitudesAdminActualizar #SolAdm_AccionDocumento").val();
        d_tipoDocumento = $("#f_solicitudesAdminActualizar #SolAdm_TipoDocumento").val();
        d_fecha = $("#f_solicitudesAdminActualizar #SolAdm_Fecha").val();
        d_pasoActual = $("#f_solicitudesAdminActualizar #SolAdm_PasoActual").val();
        d_estado = $("#f_solicitudesAdminActualizar #SolAdm_Estado").val();
        d_tipoFlujo = $("#f_solicitudesAdminActualizar #SolAdm_TipoFlujo").val();
        d_formato = $("#f_solicitudesAdminActualizar #i_SolAdm_Formato").val();
        d_PDF = $("#f_solicitudesAdminActualizar #i_SolAdm_PDF").val();
        d_observaciones = $("#f_solicitudesAdminActualizar #SolAdm_Observaciones").val();

        $.ajax({
            type: "POST",
            url: "op_solicitudesAdmActualizar.php",
            beforeSend: function () {
                bloquearFormulario("f_solicitudesAdminActualizar");
                $("#Btn_SolicitudesAdmActualizarForm").hide();
            },
            complete: function () {
                desbloquearFormulario("f_solicitudesAdminActualizar");
                $("#Btn_SolicitudesAdmActualizarForm").show();
            },
            data: {codigo: d_codigo, usuario: d_usuario, area: d_area, codigoRadicado: d_codigoRadicado, codigoDocumento: d_codigoDocumento, nombreDocumento: d_nombreDocumento, historialVersion: d_historialVersion, accionDocumento: d_accionDocumento, tipoDocumento: d_tipoDocumento, fecha: d_fecha, pasoActual: d_pasoActual, estado: d_estado, tipoFlujo: d_tipoFlujo, formato: d_formato, PDF: d_PDF, observaciones: d_observaciones},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_SolicitudesAdmNotificaciones").modal({backdrop: 'static'});
                    $(".info_SolicitudesAdmNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
                } else {
                    $("#vtn_SolicitudesAdmNotificaciones").modal({backdrop: 'static'});
                    $(".info_SolicitudesAdmNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
                    $("#Btn_SolicitudesAdmActualizarForm").show();
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", "#Btn_SolicitudesAdmNotificaciones", function (e) {
        e.preventDefault();

        $("#vtn_SolicitudesAdmNotificaciones").modal('hide');
        $("#vtn_SolicitudesAdmActualizar").modal('hide');

        d_planta = $("#FiltroCatDoc_Planta").val();

        d_area = $("#Cat_Area_Codigo").val();
        d_tipo = $("#Cat_TipoDocumento").val();
        $.ajax({
            type: "POST",
            url: "f_catalogoDocumentosListar.php",
            beforeSend: function () {
                $(".info_catalogoDocumentosListar").html(loader());
            },
            data: {area: d_area, tipo: d_tipo, planta: d_planta},
            success: function (data) {
                $(".info_catalogoDocumentosListar").html(data);
                $("#tbl_catalogoDocumentos").tablesorter();
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    // Catálogos Documentos Versiones
    $('#filtrar_CatalogoVersiones').keyup(function () {
        var rex = new RegExp($(this).val(), 'i');
        $('.buscar tr').hide();
        $('.buscar tr').filter(function () {
            return rex.test($(this).text());
        }).show();
    });
    $('#FiltroCatDocVer_Pais').multiselect({
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
    d_planta = $("#FiltroCatDocVer_Planta").val();

    d_area = $("#Cat_Area_CodigoVersiones").val();
    d_tipo = $("#Cat_TipoDocumentoVersiones").val();

    $.ajax({
        type: "POST",
        url: "f_catalogoDocumentosVersionesListar.php",
        beforeSend: function () {
            $(".info_catalogoDocumentosVersionesListar").html(loader());
        },
        data: {area: d_area, tipo: d_tipo, planta: d_planta},
        success: function (data) {
            $(".info_catalogoDocumentosVersionesListar").html(data);
            $("#tbl_catalogoDocumentosVersiones").tablesorter();
        },
        error: function (er1, er2, er3) {
            console.log(er2 + "-" + er3);
        }
    });

    $("body").on("change", "#FiltroCatDocVer_Pais", function (e) {
        e.preventDefault();
        d_pais = $(this).val();
        d_modulo = $(this).attr('data-mod');
        $.ajax({
            type: "POST",
            url: "f_cargarFiltroPlantas.php",
            beforeSend: function () {
                $(".e_cargarFiltroCatDocVerPlantas").html(loader());
            },
            data: {d_pais: d_pais, modulo: d_modulo},
            success: function (data) {
                $(".e_cargarFiltroCatDocVerPlantas").html(data);
                $('#FiltroCatDocVer_Planta').multiselect({
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
    $("body").on("click", "#Btn_CatDocVersBuscar", function (e) {
        e.preventDefault();

        d_planta = $("#FiltroCatDocVer_Planta").val();

        d_area = $("#Cat_Area_CodigoVersiones").val();
        d_tipo = $("#Cat_TipoDocumentoVersiones").val();

        $.ajax({
            type: "POST",
            url: "f_catalogoDocumentosVersionesListar.php",
            beforeSend: function () {
                $(".info_catalogoDocumentosVersionesListar").html(loader());
            },
            data: {area: d_area, tipo: d_tipo, planta: d_planta},
            success: function (data) {
                $(".info_catalogoDocumentosVersionesListar").html(data);
                $("#tbl_catalogoDocumentosVersiones").tablesorter();
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

});