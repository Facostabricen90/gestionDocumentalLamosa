d_codigoglobalsolucion = '';
$(document).ready(function (e) {

    $("body").on("click", "#filtroSolicitudes_FechaInicial", "#filtroSolicitudes_FechaFinal", function (e) {
        $(".info_solicitudesListar").html('');
    });
    $("body").on("keyup", "#filtroNombredocumento", function (e) {
        $(".info_solicitudesListar").html('');
    });
    
    $("body").on("click", "#Btn_SolicitudesCrear", function (e) {
        e.preventDefault();

        $("#vtn_SolicitudesCrear").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_solicitudesCrear.php",
            beforeSend: function () {
                $(".info_SolicitudesCrear").html(loader());
            },
            success: function (data) {
                $(".info_SolicitudesCrear").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("submit", "#f_solicitudesCrear", function (e) {
        e.preventDefault();

        d_area = $("#f_solicitudesCrear #Sol_Area_Codigo").val();
        d_tipoDocumento = $("#f_solicitudesCrear #Sol_TipoDocumento").val();
        d_tema = $("#f_solicitudesCrear #Sol_Tema").val();
        d_observaciones = $("#f_solicitudesCrear #Sol_Observaciones").val();
        d_planta= $("#f_solicitudesCrear #Sol_Pla_CodigoCrear").val();

        $.ajax({
            type: "POST",
            url: "op_solicitudesCrear.php",
            beforeSend: function () {
                bloquearFormulario("f_solicitudesCrear");
                $("#Btn_SolicitudesCrearForm").hide();
                $("#vtn_SolicitudesNotificacionesCrear").modal({backdrop: 'static'});
                $(".info_SolicitudesNotificacionesCrear").html(loader() + "<br>Enviando Correos");
                $("#Btn_SolicitudesNotificacionesCrear").hide();
            },
            complete: function () {
                desbloquearFormulario("f_solicitudesCrear");
                $("#Btn_SolicitudesCrearForm").show();
                $("#Btn_SolicitudesNotificacionesCrear").show();
            },
            data: {area: d_area, tipoDocumento: d_tipoDocumento, tema: d_tema, observaciones: d_observaciones, planta: d_planta},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {

                    $(".info_SolicitudesNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
                    window.location.href = "https://esoft.evolveyourenglish.com/user/php/op_correolamosa.php?c=frank.acosta@colombiataxis.com&n=frank&a=prueba&m=esto%20es%20una%20prueba";
                } else {
                    $("#vtn_SolicitudesNotificacionesCrear").modal({backdrop: 'static'});
                    $(".info_SolicitudesNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
                    $("#Btn_SolicitudesCrearForm").show();
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", "#Btn_SolicitudesNotificacionesCrear", function (e) {
        e.preventDefault();

        window.location.href = "fm_solicitudes.php";

    });
    
    $("body").on("change", "#Sol_Pla_CodigoCrear", function (e) {
        e.preventDefault();
        d_planta = $("#f_solicitudesCrear #Sol_Pla_CodigoCrear").val();

        $.ajax({
            type: "POST",
            url: "f_cargarSelectArea.php",
            data: {planta: d_planta},
            success: function (rs) {
               $("#Sol_Area_Codigo").html(rs);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });


    $('#FiltroSol_Pais').multiselect({
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

    $("body").on("click", "#Btn_BuscarSolicitudes", function (e) {
        e.preventDefault();
        d_planta = $("#FiltroSol_Planta").val();
        d_fechaInicial = $("#filtroSolicitudes_FechaInicial").val();
        d_fechaFinal = $("#filtroSolicitudes_FechaFinal").val();
        d_estado = $("#filtroSolicitudes_Estado").val();
        d_area = $("#Sol_Area_Nombres").val();
        d_tipo = $("#filtroSolicitudes_TipoDocumento").val();
        d_busqueda = $("#filtroNombredocumento").val();

        $.ajax({
            type: "POST",
            url: "f_solicitudesListar.php",
            beforeSend: function () {
                $(".info_solicitudesListar").html(loader());
            },
            data: {fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, estado: d_estado, area: d_area, tipo: d_tipo, planta: d_planta, busqueda: d_busqueda},
            success: function (data) {
                $(".info_solicitudesListar").html(data);
                $("#tbl_Solicitudes").tablesorter();
                $('#filtrarSolicitudesCiclo').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                });
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });
    $("body").on("change", "#FiltroSol_Pais", function (e) {
        e.preventDefault();

        d_pais = $(this).val();
        d_modulo = $(this).attr('data-mod');
        $.ajax({
            type: "POST",
            url: "f_cargarFiltroPlantas.php",
            beforeSend: function () {
                $(".e_cargarFiltroSolPlantas").html(loader());
            },
            data: {d_pais: d_pais, modulo: d_modulo},
            success: function (data) {
                $(".e_cargarFiltroSolPlantas").html(data);
                $('#FiltroSol_Planta').multiselect({
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
    $("body").on("click", ".e_aprobar", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");

        $("#vtn_SolicitudesAprobar").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_solicitudesAprobar.php",
            beforeSend: function () {
                $(".info_SolicitudesAprobar").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_SolicitudesAprobar").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("submit", "#f_solicitudesAprobar", function (e) {
        e.preventDefault();

        d_codigo = $("#f_solicitudesAprobar #Sol_CodigoApr").val();
        d_codigoDoc = $("#f_solicitudesAprobar #Sol_CodigoDocumentoApr").val();
        d_nombreDoc = $("#f_solicitudesAprobar #Sol_NombreDocumentoApr").val();

        $.ajax({
            type: "POST",
            url: "op_aprobarSolicitud.php",
            beforeSend: function () {
                bloquearFormulario("f_solicitudesAprobar");
                $("#Btn_SolicitudesCrearForm").hide();
            },
            complete: function () {
                desbloquearFormulario("f_solicitudesAprobar");
                $("#Btn_SolicitudesCrearForm").show();
            },
            data: {codigo: d_codigo, codigoDoc: d_codigoDoc, nombreDoc: d_nombreDoc},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                    $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Aprobado Correctamente</h3>');

                } else {
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });


    $("body").on("click", ".e_rechazarSolicitud", function (e) {
        e.preventDefault();

        d_codigo = $("#f_solicitudesAprobar #Sol_CodigoApr").val();

        $.ajax({
            type: "POST",
            url: "op_rechazarSolicitud.php",
            beforeSend: function () {
                bloquearFormulario("f_solicitudesAprobar");
                $("#Btn_SolicitudesCrearForm").hide();
            },
            complete: function () {
                desbloquearFormulario("f_solicitudesAprobar");
                $("#Btn_SolicitudesCrearForm").show();
            },
            data: {codigo: d_codigo},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                    $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Rechazado Correctamente</h3>');

                } else {
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", "#Btn_SolicitudesNotificacionesAprobar", function (e) {
        e.preventDefault();
        $("#vtn_SolicitudesGestionar").modal('hide');
        $("#vtn_SolicitudesNotificacionesAprobar").modal('hide');
        d_planta = $("#FiltroArea_Planta").val();
        d_fechaInicial = $("#filtroSolicitudes_FechaInicial").val();
        d_fechaFinal = $("#filtroSolicitudes_FechaFinal").val();
        d_estado = $("#filtroSolicitudes_Estado").val();
        d_area = $("#Sol_Area_Codigo").val();
        d_tipo = $("#filtroSolicitudes_TipoDocumento").val();
        d_busqueda = $("#filtroNombredocumento").val();

        $.ajax({
            type: "POST",
            url: "f_solicitudesListar.php",
            beforeSend: function () {
                $(".info_solicitudesListar").html(loader());
            },
            data: {fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, estado: d_estado, area: d_area, tipo: d_tipo, busqueda: d_busqueda},
            success: function (data) {
                $(".info_solicitudesListar").html(data);
                $("#tbl_Solicitudes").tablesorter();
                $('#filtrarSolicitudesCiclo').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                });
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("click", ".e_cargarSolicitudGestion", function (e) {
        e.preventDefault();
        $("#Sol_CodigoDocumentoGestionarNuevo").mask("000");
        d_codigo = $(this).attr("data-cod");

        $("#vtn_SolicitudesGestionar").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_solicitudesflujoAprobacionesUsuarios.php",
            beforeSend: function () {
                $(".info_SolicitudesGestionar").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_SolicitudesGestionar").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("submit", "#f_solicitudesGestionarCrear", function (e) {
        e.preventDefault();

        d_paso = $("#f_solicitudesGestionarCrear #Sol_PasoActual").val();
        d_codigo = $("#f_solicitudesGestionarCrear #Sol_CodigoActualSolicitudProcesando").val();

        if (d_paso == "2") {
            d_accionDocumento = $("#f_solicitudesGestionarCrear #Sol_AccionDocumentoGestionar").val();
            if (d_accionDocumento == "Actualización") {
                d_tipoDocumento = $("#f_solicitudesGestionarCrear #Sol_TipoDocumentoGestionarAct").val();
                d_codigoDocumento = $("#f_solicitudesGestionarCrear #Sol_CodigoDocumentoGestionar").val();
                d_nombreDocumento = $("#f_solicitudesGestionarCrear #Sol_NombreDocumentoGestionar").val();
                d_historialVersion = $("#f_solicitudesGestionarCrear #Sol_HistorialVersionGestionar").val();
                d_pasoSiguiente = $("#f_solicitudesGestionarCrear #filtroPaso3SaltoPasos").val();
                d_formato = $("#f_solicitudesGestionarCrear #i_Sol_FormatoGestionar").val();
                d_planta = $("#Codigo_PlaAct :selected").attr("data-cod");
            } else {
                d_tipoDocumento = $("#f_solicitudesGestionarCrear #Sol_TipoDocumentoGestionar").val();
                d_codigoDocumento = $("#f_solicitudesGestionarCrear #Sol_CodigoDocumentoGestionar").val();
                d_nombreDocumento = $("#f_solicitudesGestionarCrear #Sol_NombreDocumentoGestionar").val();
                d_historialVersion = $("#f_solicitudesGestionarCrear #Sol_HistorialVersionGestionar").val();
                d_pasoSiguiente = $("#f_solicitudesGestionarCrear #filtroPaso3SaltoPasos").val();
                d_planta = $("#Codigo_Pla :selected").attr("data-cod");
                d_formato = "NO APLICA";
            }

            $.ajax({
                type: "POST",
                url: "op_solicitudFlujoAprobacionesPasosCrear.php",
                beforeSend: function () {
                    bloquearFormulario("f_solicitudesGestionarCrear");
                    $("#Btn_SolicitudesCrearForm").hide();
                    $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                    $(".info_SolicitudesNotificacionesAprobar").html(loader() + "<br>Enviando Correos");
                    $("#Btn_SolicitudesNotificacionesAprobar").hide();
                },
                complete: function () {
                    desbloquearFormulario("f_solicitudesGestionarCrear");
                    $("#Btn_SolicitudesNotificacionesAprobar").show();
                },
                data: {codigo: d_codigo, paso: d_paso, accionDocumento: d_accionDocumento, tipoDocumento: d_tipoDocumento, codigoDocumento: d_codigoDocumento, nombreDocumento: d_nombreDocumento, historialVersion: d_historialVersion, formato: d_formato, pasoSiguiente: d_pasoSiguiente, planta: d_planta},
                dataType: 'json',
                success: function (rs) {

                    if (rs.mensaje == "OK") {
                        $(".info_solicitudesListar").html('');
                        window.location.href = "https://esoft.evolveyourenglish.com/user/php/op_correolamosa.php?c=frank.acosta@colombiataxis.com&n="+ rs.nombre +"&a=prueba&m=Asignación de Lineamientos Tipo Documento: " + rs.tip + " Código Documento: " + rs.codDoc + " Nombre Documento: " + rs.nomDoc + " Versión: " + rs.ver + " Área: " + rs.are + " Fecha Solicitud: " + rs.fechaSol + " Usuario Solicita: " + rs.usuSol + " Atte, Cerámica San Lorenzo'";
                        $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra22 verde"></span><h3>Solicitud Gestionada Correctamente.</h3>');
                        $("#Btn_SolicitudesCrearForm").show();

                    } else {
                        $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                        $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-remove letra22 rojo"></span><h3>Solicitud NO Gestionada</h3>');
                        $("#Btn_SolicitudesCrearForm").show();
                        mensaje('2', rs.mensaje);
                    }
                },
                error: function (er1, er2, er3) {
                    console.log(er1);
                    console.log(er2);
                    console.log(er3);
                }
            });
        }

        if (d_paso == "3") {
            d_observaciones = $("#f_solicitudesGestionarCrear #HistF_ObservacionGestionarLineamientos").val();

            $.ajax({
                type: "POST",
                url: "op_solicitudFlujoAprobacionesPasosCrear.php",
                beforeSend: function () {
                    bloquearFormulario("f_solicitudesGestionarCrear");
                    $("#Btn_SolicitudesCrearForm").hide();
                    $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                    $(".info_SolicitudesNotificacionesAprobar").html(loader() + "<br>Enviando Correos");
                    $("#Btn_SolicitudesNotificacionesAprobar").hide();
                },
                complete: function () {
                    desbloquearFormulario("f_solicitudesGestionarCrear");
                    $("#Btn_SolicitudesNotificacionesAprobar").show();
                },
                data: {codigo: d_codigo, paso: d_paso, observaciones: d_observaciones},
                dataType: 'json',
                success: function (rs) {
                    if (rs.mensaje == "OK") {
                        window.location.href = "https://sugerencias.lamosa.com/correos/gestiondocumental/op_gestiondocumental.php?codigo=" + d_codigo + "&paso=" + d_paso + "&observaciones=" + d_observaciones + "" + "&planta=" + rs.planta + "&area=" + rs.areas;
                        $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra22 verde"></span><h3>Lineamientos Asignados Correctamente.</h3>');
                        $("#Btn_SolicitudesCrearForm").show();
                    } else {
                        $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                        $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-remove letra22 rojo"></span><h3>Lineamientos NO Asignados</h3>');
                        $("#Btn_SolicitudesCrearForm").show();
                        mensaje('2', rs.mensaje);
                    }
                },
                error: function (er1, er2, er3) {
                    console.log(er2 + "-" + er3);
                }
            });
        }

        if (d_paso == "4") {
            d_observaciones = $("#f_solicitudesGestionarCrear #HistF_ObservacionGestionarDocumentoElaboracion").val();
            d_archivo = $("#f_solicitudesGestionarCrear #i_Sol_FormatoGestionarElaboracion").val();

            if (d_archivo != "") {
                $.ajax({
                    type: "POST",
                    url: "op_solicitudFlujoAprobacionesPasosCrear.php",
                    beforeSend: function () {
                        bloquearFormulario("f_solicitudesGestionarCrear");
                        $("#Btn_SolicitudesCrearForm").hide();
                        $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                        $(".info_SolicitudesNotificacionesAprobar").html(loader() + "<br>Enviando Correos");
                        $("#Btn_SolicitudesNotificacionesAprobar").hide();
                    },
                    complete: function () {
                        desbloquearFormulario("f_solicitudesGestionarCrear");
                        $("#Btn_SolicitudesNotificacionesAprobar").show();
                    },
                    data: {codigo: d_codigo, paso: d_paso, observaciones: d_observaciones, archivo: d_archivo},
                    dataType: 'json',
                    success: function (rs) {
                        if (rs.mensaje == "OK") {

                            window.location.href = "https://sugerencias.lamosa.com/correos/gestiondocumental/op_gestiondocumental.php?codigo=" + d_codigo + "&paso=" + d_paso + "&observaciones=" + d_observaciones + "" + "&planta=" + rs.planta + "&area=" + rs.areas;
                            $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra22 verde"></span><h3>Documento Elaborado Correctamente.</h3>');
                            $("#Btn_SolicitudesCrearForm").show();
                        } else {
                            $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                            $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-remove letra22 rojo"></span><h3>Documento NO Elaborado Correctamente.</h3>');
                            $("#Btn_SolicitudesCrearForm").show();
                            mensaje('2', rs.mensaje);
                        }
                    },
                    error: function (er1, er2, er3) {
                        console.log(er1);
                        console.log(er2);
                        console.log(er3);
                    }
                });
            } else {
                $(".Men_ObliCargarArcElaborado").html('<div class="alert alert-danger"><strong>El Documento Actualizado es Obligatorio Cargarlo para Continuar su Flujo</strong></div>');
            }
        }

        if (d_paso == "8") {//5
            d_calificacion = $("#f_solicitudesGestionarCrear #HistF_CaliificacionGestionarRevision").val();
            d_observaciones = $("#f_solicitudesGestionarCrear #HistF_ObservacionGestionarRevision").val();
            d_archivo = $("#f_solicitudesGestionarCrear #i_Sol_FormatoGestionarRevision").val();

            if (d_archivo != "") {
                $.ajax({
                    type: "POST",
                    url: "op_solicitudFlujoAprobacionesPasosCrear.php",
                    beforeSend: function () {
                        bloquearFormulario("f_solicitudesGestionarCrear");
                        $("#Btn_SolicitudesCrearForm").hide();
                        $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                        $(".info_SolicitudesNotificacionesAprobar").html(loader() + "<br>Enviando Correos");
                        $("#Btn_SolicitudesNotificacionesAprobar").hide();
                    },
                    complete: function () {
                        desbloquearFormulario("f_solicitudesGestionarCrear");
                        $("#Btn_SolicitudesNotificacionesAprobar").show();
                    },
                    data: {codigo: d_codigo, paso: d_paso, observaciones: d_observaciones, calificacion: d_calificacion, archivo: d_archivo},
                    dataType: 'json',
                    success: function (rs) {
                        if (rs.mensaje == "OK") {

                            window.location.href = "https://sugerencias.lamosa.com/correos/gestiondocumental/op_gestiondocumental.php?codigo=" + d_codigo + "&paso=" + d_paso + "&calificacion=" + d_calificacion + "&observaciones=" + d_observaciones + "" + "&planta=" + rs.planta + "&area=" + rs.areas;
                            $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra22 verde"></span><h3>Revisión Creada Correctamente.</h3>');
                            $("#Btn_SolicitudesCrearForm").show();
                        } else {
                            $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                            $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-remove letra22 rojo"></span><h3>Revisión NO Creada Correctamente.</h3>');
                            $("#Btn_SolicitudesCrearForm").show();
                            mensaje('2', rs.mensaje);
                        }
                    },
                    error: function (er1, er2, er3) {
                        console.log(er2 + "-" + er3);
                    }
                });
            } else {
                $(".Men_ObliCargarArcRevision").html('<div class="alert alert-danger"><strong>Él Documento Revisado es Obligatorio Cargarlo para Continuar su Flujo</strong></div>');
            }
        }

        if (d_paso == "7") {//6
            d_observaciones = $("#f_solicitudesGestionarCrear #HistF_ObservacionGestionarAjuste").val();
            d_archivo = $("#f_solicitudesGestionarCrear #i_Sol_FormatoGestionarAjuste").val();

            if (d_archivo != "") {

                $.ajax({
                    type: "POST",
                    url: "op_solicitudFlujoAprobacionesPasosCrear.php",
                    beforeSend: function () {
                        bloquearFormulario("f_solicitudesGestionarCrear");
                        $("#Btn_SolicitudesCrearForm").hide();
                        $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                        $(".info_SolicitudesNotificacionesAprobar").html(loader() + "<br>Enviando Correos");
                        $("#Btn_SolicitudesNotificacionesAprobar").hide();
                    },
                    complete: function () {
                        desbloquearFormulario("f_solicitudesGestionarCrear");
                        $("#Btn_SolicitudesNotificacionesAprobar").show();
                    },
                    data: {codigo: d_codigo, paso: d_paso, observaciones: d_observaciones, archivo: d_archivo},
                    dataType: 'json',
                    success: function (rs) {
                        if (rs.mensaje == "OK") {

                            window.location.href = "https://sugerencias.lamosa.com/correos/gestiondocumental/op_gestiondocumental.php?codigo=" + d_codigo + "&paso=" + d_paso + "&observaciones=" + d_observaciones + "" + "&planta=" + rs.planta + "&area=" + rs.areas;
                            $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra22 verde"></span><h3>Ajuste Creado Correctamente.</h3>');
                            $("#Btn_SolicitudesCrearForm").show();
                        } else {
                            $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                            $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-remove letra22 rojo"></span><h3>Ajuste NO Creado Correctamente.</h3>');
                            $("#Btn_SolicitudesCrearForm").show();
                            mensaje('2', rs.mensaje);
                        }
                    },
                    error: function (er1, er2, er3) {
                        console.log(er2 + "-" + er3);
                    }
                });
            } else {
                $(".Men_ObliCargarArcAjuste").html('<div class="alert alert-danger"><strong>Él Documento Ajustado es Obligatorio Cargarlo para Continuar su Flujo</strong></div>');
            }
        }

        /*
         CONFIRMIDAD
         if(d_paso == "8"){
         d_calificacion = $("#f_solicitudesGestionarCrear #HistF_CalificacionGestionarConformidad").val();
         d_observaciones = $("#f_solicitudesGestionarCrear #HistF_ObservacionGestionarConformidad").val();
         
         $.ajax({
         type:"POST",
         url:"op_solicitudFlujoAprobacionesPasosCrear.php",
         beforeSend: function() {
         bloquearFormulario("f_solicitudesGestionarCrear");
         $("#Btn_SolicitudesCrearForm").hide();
         },
         complete: function() {
         desbloquearFormulario("f_solicitudesGestionarCrear");
         },
         data: { codigo: d_codigo, paso: d_paso, observaciones: d_observaciones, calificacion: d_calificacion },
         dataType: 'json',
         success: function(rs) {
         if(rs.mensaje == "OK"){
         $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
         $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra22 verde"></span><h3>Conformidad Creada Correctamente.</h3>');
         $("#Btn_SolicitudesCrearForm").show();
         }else{
         $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
         $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-remove letra22 rojo"></span><h3>Conformidad NO Creada Correctamente.</h3>');
         $("#Btn_SolicitudesCrearForm").show();
         mensaje('2', rs.mensaje);
         }
         },
         error: function(er1, er2, er3) {
         console.log(er2+"-"+er3);
         }
         });
         }*/

        if (d_paso == "5") {
            d_calificacion = $("#f_solicitudesGestionarCrear #HistF_CalificacionGestionarRevisionAprobacionEHS").val();
            d_observaciones = $("#f_solicitudesGestionarCrear #HistF_ObservacionGestionarRevisionAprobacionEHS").val();
            d_archivo = $("#f_solicitudesGestionarCrear #i_Sol_FormatoGestionarAjusteEHS").val();

            if (d_archivo != "") {
                $.ajax({
                    type: "POST",
                    url: "op_solicitudFlujoAprobacionesPasosCrear.php",
                    beforeSend: function () {
                        bloquearFormulario("f_solicitudesGestionarCrear");
                        $("#Btn_SolicitudesCrearForm").hide();
                        $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                        $(".info_SolicitudesNotificacionesAprobar").html(loader() + "<br>Enviando Correos");
                        $("#Btn_SolicitudesNotificacionesAprobar").hide();
                    },
                    complete: function () {
                        desbloquearFormulario("f_solicitudesGestionarCrear");
                        $("#Btn_SolicitudesNotificacionesAprobar").show();
                    },
                    data: {codigo: d_codigo, paso: d_paso, observaciones: d_observaciones, calificacion: d_calificacion, archivo: d_archivo},
                    dataType: 'json',
                    success: function (rs) {
                        if (rs.mensaje == "OK") {
                            window.location.href = "https://sugerencias.lamosa.com/correos/gestiondocumental/op_gestiondocumental.php?codigo=" + d_codigo + "&paso=" + d_paso + "&calificacion=" + d_calificacion + "&observaciones=" + d_observaciones + "" + "&planta=" + rs.planta + "&area=" + rs.areas;
                            $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra22 verde"></span><h3>Aprobación Creada Correctamente.</h3>');
                            $("#Btn_SolicitudesCrearForm").show();
                        } else {
                            $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                            $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-remove letra22 rojo"></span><h3>Aprobación NO Creada Correctamente.</h3>');
                            $("#Btn_SolicitudesCrearForm").show();
                            mensaje('2', rs.mensaje);
                        }
                    },
                    error: function (er1, er2, er3) {
                        console.log(er1);
                        console.log(er2);
                        console.log(er3);
                    }
                });
            } else {
                $(".Men_ObliCargarArcElaborado").html('<div class="alert alert-danger"><strong>Él Documento Actualizado es Obligatorio Cargarlo para Continuar su Flujo</strong></div>');
            }
        }

        /*if(d_paso == "8"){
         d_observaciones = $("#f_solicitudesGestionarCrear #HistF_ObservacionGestionarRevisionAjusteEHS").val();
         d_archivo = $("#f_solicitudesGestionarCrear #i_Sol_FormatoGestionarAjusteEHS").val();
         
         if(d_archivo != ""){
         
         $.ajax({
         type:"POST",
         url:"op_solicitudFlujoAprobacionesPasosCrear.php",
         beforeSend: function() {
         bloquearFormulario("f_solicitudesGestionarCrear");
         $("#Btn_SolicitudesCrearForm").hide();
         $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
         $(".info_SolicitudesNotificacionesAprobar").html(loader()+"<br>Enviando Correos");
         $("#Btn_SolicitudesNotificacionesAprobar").hide();
         },
         complete: function() {
         desbloquearFormulario("f_solicitudesGestionarCrear");
         $("#Btn_SolicitudesNotificacionesAprobar").show();
         
         },
         data: { codigo: d_codigo, paso: d_paso, observaciones: d_observaciones, archivo: d_archivo },
         dataType: 'json',
         success: function(rs) {
         if(rs.mensaje == "OK"){
         window.location.href = "https://sugerencias.lamosa.com/correos/gestiondocumental/op_gestiondocumental.php?codigo="+d_codigo+"&paso="+d_paso+"&observaciones="+d_observaciones+"";
         $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra22 verde"></span><h3>Ajuste Creado Correctamente.</h3>');
         $("#Btn_SolicitudesCrearForm").show();
         }else{
         $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
         $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-remove letra22 rojo"></span><h3>Ajuste NO Creado Correctamente.</h3>');
         $("#Btn_SolicitudesCrearForm").show();
         mensaje('2', rs.mensaje);
         }
         },
         error: function(er1, er2, er3) {
         console.log(er2+"-"+er3);
         }
         });
         }else{
         $(".Men_ObliCargarArcAjusteEHS").html('<div class="alert alert-danger"><strong>Él Documento Elaborado es Obligatorio Cargarlo para Continuar su Flujo</strong></div>');
         }
         }
         */
        if (d_paso == "6") {
            d_calificacion = $("#f_solicitudesGestionarCrear #HistF_CalificacionGestionarRevisionAprobacionJefe").val();
            d_observaciones = $("#f_solicitudesGestionarCrear #HistF_ObservacionGestionarRevisionAprobacionJefe").val();
            d_archivo = $("#f_solicitudesGestionarCrear #i_Sol_FormatoGestionarAjusteJefeAprobadorFinal").val();

            if (d_archivo != "") {
                $.ajax({
                    type: "POST",
                    url: "op_solicitudFlujoAprobacionesPasosCrear.php",
                    beforeSend: function () {
                        bloquearFormulario("f_solicitudesGestionarCrear");
                        $("#Btn_SolicitudesCrearForm").hide();
                        $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                        $(".info_SolicitudesNotificacionesAprobar").html(loader() + "<br>Enviando Correos");
                        $("#Btn_SolicitudesNotificacionesAprobar").hide();
                    },
                    complete: function () {
                        desbloquearFormulario("f_solicitudesGestionarCrear");
                        $("#Btn_SolicitudesNotificacionesAprobar").show();
                    },
                    data: {codigo: d_codigo, paso: d_paso, observaciones: d_observaciones, calificacion: d_calificacion, archivo: d_archivo},
                    dataType: 'json',
                    success: function (rs) {
                        if (rs.mensaje == "OK") {
                            window.location.href = "https://sugerencias.lamosa.com/correos/gestiondocumental/op_gestiondocumental.php?codigo=" + d_codigo + "&paso=" + d_paso + "&calificacion=" + d_calificacion + "&observaciones=" + d_observaciones + "" + "&planta=" + rs.planta + "&area=" + rs.areas;
                            $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra22 verde"></span><h3>Aprobación Creada Correctamente.</h3>');
                            $("#Btn_SolicitudesCrearForm").show();
                        } else {
                            $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                            $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-remove letra22 rojo"></span><h3>Aprobación NO Creada Correctamente.</h3>');
                            $("#Btn_SolicitudesCrearForm").show();
                            mensaje('2', rs.mensaje);
                        }
                    },
                    error: function (er1, er2, er3) {
                        console.log(er1);
                        console.log(er2);
                        console.log(er3);
                    }
                });
            } else {
                $(".Men_ObliCargarArcElaborado").html('<div class="alert alert-danger"><strong>Él Documento Actualizado es Obligatorio Cargarlo para Continuar su Flujo</strong></div>');
            }
//			d_calificacion = $("#f_solicitudesGestionarCrear #HistF_CalificacionGestionarAprobacion").val();
//			d_observaciones = $("#f_solicitudesGestionarCrear #HistF_ObservacionGestionarAprobacion").val();
//	
//      $.ajax({
//        type:"POST",
//        url:"op_solicitudFlujoAprobacionesPasosCrear.php",
//        beforeSend: function() {
//          bloquearFormulario("f_solicitudesGestionarCrear");
//          $("#Btn_SolicitudesCrearForm").hide();
//          $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
//          $(".info_SolicitudesNotificacionesAprobar").html(loader()+"<br>Enviando Correos");
//          $("#Btn_SolicitudesNotificacionesAprobar").hide();
//        },
//        complete: function() {
//          desbloquearFormulario("f_solicitudesGestionarCrear");
//          $("#Btn_SolicitudesNotificacionesAprobar").show();
//        },
//        data: { codigo: d_codigo, paso: d_paso, observaciones: d_observaciones, calificacion: d_calificacion },
//        dataType: 'json',
//        success: function(rs) {
//          if(rs.mensaje == "OK"){
//            $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra22 verde"></span><h3>Ajuste Creado Correctamente.</h3>');
//            $("#Btn_SolicitudesCrearForm").show();
//          }else{
//            $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
//            $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-remove letra22 rojo"></span><h3>Ajuste NO Creado Correctamente.</h3>');
//            $("#Btn_SolicitudesCrearForm").show();
//            mensaje('2', rs.mensaje);
//          }
//        },
//        error: function(er1, er2, er3) {
//          console.log(er2+"-"+er3);
//        }
//      });
        }

        if (d_paso == "9") {//10


            d_calificacion = $("#f_solicitudesGestionarCrear #HistF_CalificacionGestionarAprobacion").val();
            d_observaciones = $("#f_solicitudesGestionarCrear #HistF_ObservacionGestionarAprobacion").val();

            $.ajax({
                type: "POST",
                url: "op_solicitudFlujoAprobacionesPasosCrear.php",
                beforeSend: function () {
                    bloquearFormulario("f_solicitudesGestionarCrear");
                    $("#Btn_SolicitudesCrearForm").hide();
                    $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                    $(".info_SolicitudesNotificacionesAprobar").html(loader() + "<br>Enviando Correos");
                    $("#Btn_SolicitudesNotificacionesAprobar").hide();
                },
                complete: function () {
                    desbloquearFormulario("f_solicitudesGestionarCrear");
                    $("#Btn_SolicitudesNotificacionesAprobar").show();
                },
                data: {codigo: d_codigo, paso: d_paso, observaciones: d_observaciones, calificacion: d_calificacion},
                dataType: 'json',
                success: function (rs) {
                    if (rs.mensaje == "OK") {
                        window.location.href = "https://sugerencias.lamosa.com/correos/gestiondocumental/op_gestiondocumental.php?codigo=" + d_codigo + "&paso=" + d_paso + "&calificacion=" + d_calificacion + "&observaciones=" + d_observaciones + "" + "&planta=" + rs.planta + "&area=" + rs.areas;
                        $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra22 verde"></span><h3>Ajuste Creado Correctamente.</h3>');
                        $("#Btn_SolicitudesCrearForm").show();
                    } else {
                        $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                        $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-remove letra22 rojo"></span><h3>Ajuste NO Creado Correctamente.</h3>');
                        $("#Btn_SolicitudesCrearForm").show();
                        mensaje('2', rs.mensaje);
                    }
                },
                error: function (er1, er2, er3) {
                    console.log(er1);
                    console.log(er2);
                    console.log(er3);
                }
            });
//			d_observaciones = $("#f_solicitudesGestionarCrear #HistF_ObservacionGestionarRevisionAjusteJefeAprobadorFinal").val();
//			d_archivo = $("#f_solicitudesGestionarCrear #i_Sol_FormatoGestionarAjusteJefeAprobadorFinal").val();
//			
//			if(d_archivo != ""){
//	
//				$.ajax({
//					type:"POST",
//					url:"op_solicitudFlujoAprobacionesPasosCrear.php",
//					beforeSend: function() {
//						bloquearFormulario("f_solicitudesGestionarCrear");
//						$("#Btn_SolicitudesCrearForm").hide();
//            $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
//            $(".info_SolicitudesNotificacionesAprobar").html(loader()+"<br>Enviando Correos");
//            $("#Btn_SolicitudesNotificacionesAprobar").hide();
//					},
//					complete: function() {
//						desbloquearFormulario("f_solicitudesGestionarCrear");
//            $("#Btn_SolicitudesNotificacionesAprobar").show();
//					},
//					data: { codigo: d_codigo, paso: d_paso, observaciones: d_observaciones, archivo: d_archivo },
//					dataType: 'json',
//					success: function(rs) {
//						if(rs.mensaje == "OK"){
//							$(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra22 verde"></span><h3>Ajuste Creado Correctamente.</h3>');
//							$("#Btn_SolicitudesCrearForm").show();
//						}else{
//							$("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
//							$(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-remove letra22 rojo"></span><h3>Ajuste NO Creado Correctamente.</h3>');
//							$("#Btn_SolicitudesCrearForm").show();
//							mensaje('2', rs.mensaje);
//						}
//					},
//					error: function(er1, er2, er3) {
//						console.log(er2+"-"+er3);
//					}
//				});
//			}else{
//				$(".Men_ObliCargarArcAjusteJefeAprobadorFinal").html('<div class="alert alert-danger"><strong>Él Documento Elaborado es Obligatorio Cargarlo para Continuar su Flujo</strong></div>');
//			}
        }

        if (d_paso == "10") { //11
            d_observaciones = $("#f_solicitudesGestionarCrear #HistF_ObservacionGestionarRevisionPDF").val();
            d_archivo = $("#f_solicitudesGestionarCrear #i_Sol_FormatoGestionarPDF").val();
            d_validador = d_archivo.split(".");
            d_val2 = d_validador[d_validador.length - 1]
            if (d_archivo != "") {
                if (d_val2.toUpperCase() == 'PDF') {

                    $.ajax({
                        type: "POST",
                        url: "op_solicitudFlujoAprobacionesPasosCrear.php",
                        beforeSend: function () {
                            bloquearFormulario("f_solicitudesGestionarCrear");
                            $("#Btn_SolicitudesCrearForm").hide();
                            $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                            $(".info_SolicitudesNotificacionesAprobar").html(loader() + "<br>Enviando Correos");
                            $("#Btn_SolicitudesNotificacionesAprobar").hide();
                        },
                        complete: function () {
                            desbloquearFormulario("f_solicitudesGestionarCrear");
                            $("#Btn_SolicitudesNotificacionesAprobar").show();
                        },
                        data: {codigo: d_codigo, paso: d_paso, observaciones: d_observaciones, archivo: d_archivo},
                        dataType: 'json',
                        success: function (rs) {
                            if (rs.mensaje == "OK") {
                                window.location.href = "https://sugerencias.lamosa.com/correos/gestiondocumental/op_gestiondocumental.php?codigo=" + d_codigo + "&paso=" + d_paso + "&observaciones=" + d_observaciones + "" + "&planta=" + rs.planta + "&area=" + rs.areas;
                                $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                                $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra22 verde"></span><h3>Documento PDF Subido Correctamente.</h3>');
                                $("#Btn_SolicitudesCrearForm").show();
                            } else {
                                $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                                $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-remove letra22 rojo"></span><h3>Documento PDF NO Subido Correctamente.</h3>');
                                $("#Btn_SolicitudesCrearForm").show();
                                mensaje('2', rs.mensaje);
                            }
                        },
                        error: function (er1, er2, er3) {
                            console.log(er1);
                            console.log(er2);
                            console.log(er3);
                        }
                    });
                } else {
                    $("#f_solicitudesGestionarCrear #i_Sol_FormatoGestionarPDF").val("");
                    $(".e_mensajeAprobacionPDF").html('<div class="alert alert-danger"><strong>El documento que insertó no es PDF</strong></div>');
                }
            } else {
                $(".e_mensajeAprobacionPDF").html('<div class="alert alert-danger"><strong>El PDF del Documento a Publicar es Obligatorio</strong></div>');
            }
        }

        if (d_paso == "11") {//12
            d_observaciones = $("#f_solicitudesGestionarCrear #HistF_ObservacionGestionarRevisionDivulgacion").val();
            //d_archivo = $("#f_solicitudesGestionarCrear #i_Sol_FormatoGestionarPDF").val();

            $.ajax({
                type: "POST",
                url: "op_solicitudFlujoAprobacionesPasosCrear.php",
                beforeSend: function () {
                    bloquearFormulario("f_solicitudesGestionarCrear");
                    $("#Btn_SolicitudesCrearForm").hide();
                    $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                    $(".info_SolicitudesNotificacionesAprobar").html(loader() + "<br>Enviando Correos");
                    $("#Btn_SolicitudesNotificacionesAprobar").hide();
                },
                complete: function () {
                    desbloquearFormulario("f_solicitudesGestionarCrear");
                    $("#Btn_SolicitudesNotificacionesAprobar").show();
                },
                data: {codigo: d_codigo, paso: d_paso, observaciones: d_observaciones},
                dataType: 'json',
                success: function (rs) {
                    if (rs.mensaje == "OK") {
                        $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                        $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra22 verde"></span><h3>Documento Publicado Correctamente.</h3>');
                        $("#Btn_SolicitudesCrearForm").show();
                    } else {
                        $("#vtn_SolicitudesNotificacionesAprobar").modal({backdrop: 'static'});
                        $(".info_SolicitudesNotificacionesAprobar").html('<span class="glyphicon glyphicon-remove letra22 rojo"></span><h3>Documento NO Publicado Correctamente.</h3>');
                        $("#Btn_SolicitudesCrearForm").show();
                        mensaje('2', rs.mensaje);
                    }
                },
                error: function (er1, er2, er3) {
                    console.log(er1);
                    console.log(er2);
                    console.log(er3);
                }
            });

        }

    });

    $("body").on("change", "#f_solicitudesGestionarCrear #Sol_AccionDocumentoGestionar", function (e) {
        e.preventDefault();
        d_accionDocumento = $("#f_solicitudesGestionarCrear #Sol_AccionDocumentoGestionar").val();
        d_codigo = $("#f_solicitudesGestionarCrear #Sol_CodigoActualSolicitudProcesando").val();


        $.ajax({
            type: "POST",
            url: "f_accionesDocumentoPaso3Gestionar.php",
            beforeSend: function () {
                $(".Info_AccionesDocumentoPaso3_Gestionar").html(loader());
            },
            data: {codigo: d_codigo, accionDocumento: d_accionDocumento},
            success: function (data) {
                $(".Info_AccionesDocumentoPaso3_Gestionar").html(data);
                if (d_accionDocumento == 'Nuevo') {
                    d_planta = $('#Codigo_Pla').val() + '-';
                    d_tipo = $('#Sol_TipoDocumentoGestionar option:selected').attr("data-cod") + '-';
                    d_area = $('#Sol_Are').val() + '-';
                    d_num = $('#Sol_CodigoDocumentoGestionarNuevo').val();
                    d_codigo = d_planta + d_tipo + d_area;
                    $.ajax({
                        type: "POST",
                        url: "op_cargarCodigo.php",
                        dataType: 'json',
                        data: {planta: d_planta, tipo: d_tipo, area: d_area, num: d_num},
                        success: function (data) {
                            $("#f_solicitudesGestionarCrear #Sol_CodigoDocumentoGestionar").val(data.codigo);
                            $("#f_solicitudesGestionarCrear #Sol_CodigoDocumentoGestionarLabel").html('<label>' + data.codigo + '</label>');
                            $.ajax({
                                type: "POST",
                                url: "f_listarVersion.php",
                                beforeSend: function () {
                                    $(".e_tablaAnterior").html(loader());
                                },
                                data: {codigo: d_codigo},
                                success: function (data) {
                                    $(".e_tablaAnterior").html(data);
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
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });



    });

    $("body").on("click", ".e_cargarCapacitacionesSolicitudes", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");

        $("#vtn_CapacitacionesOperarios").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_capacitacionesOperariosCrear.php",
            beforeSend: function () {
                $(".info_CapacitacionesOperarios").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_CapacitacionesOperarios").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er1);
                console.log(er2);
                console.log(er3);
            }
        });

    });

    $("body").on("click", ".e_guardarCapacitacionesMasivas", function (e) {
        e.preventDefault();

        d_num = $(this).attr("data-num");
        d_codigo = $(this).attr("data-cod");
        d_fecha = $("#CapO_Fecha").val();
        d_hora = $("#CapO_HorasCapacitacion").val();

        d_lista1 = [];
        d_lista2 = [];
        d_lista3 = [];
        d_lista4 = [];
        d_lista5 = [];
        d_lista6 = [];

        cont = 0;
        for (a = 0; a < d_num; a++) {
            d_lista1[cont] = $("#C_Capacitado" + a).prop("checked");
            d_lista2[cont] = $("#C_Novedades" + a).prop("checked");
            d_lista3[cont] = $("#C_Observaciones" + a).val();
            d_lista4[cont] = $("#C_CodigoOperario" + a).val();
            d_lista5[cont] = $("#C_Accion" + a).val();
            d_lista6[cont] = $("#C_CodigoCapacitacion" + a).val();
            cont++;
        }

        d_nume = cont;

        $.ajax({
            type: "POST",
            url: "op_capacitacionesOperariosCrear.php",
            beforeSend: function () {
                $(".e_guardarCapacitacionesMasivas").hide();
            },
            complete: function () {
                $(".e_guardarCapacitacionesMasivas").show();
            },
            data: {codigo: d_codigo, lista1: d_lista1, lista2: d_lista2, lista3: d_lista3, lista4: d_lista4, lista5: d_lista5, lista6: d_lista6, num: d_nume, fecha: d_fecha, hora: d_hora},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_CapacitacionesOperarios").modal('hide');

                    $.ajax({
                        type: "POST",
                        url: "f_solicitudesflujoAprobacionesUsuarios.php",
                        beforeSend: function () {
                            $(".info_SolicitudesGestionar").html(loader());
                        },
                        data: {codigo: d_codigo},
                        success: function (data) {
                            $(".info_SolicitudesGestionar").html(data);
                        },
                        error: function (er1, er2, er3) {
                            console.log(er2 + "-" + er3);
                        }
                    });
                } else {
                    $(".e_guardarCapacitacionesMasivas").show();
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("keyup", "#Sol_HistorialVersionGestionar", function (e) {
        e.preventDefault();

        d_codigo = $("#Sol_CodigoDocumentoGestionar").val();
        d_version = $("#Sol_HistorialVersionGestionar").val();

        $.ajax({
            type: "POST",
            url: "op_validarVersion.php",
            beforeSend: function () {
            },
            data: {codigo: d_codigo, version: d_version},
            dataType: 'json',
            success: function (data) {
                if (data.valorVersion > 0) {
                    $(".e_mensajeValVersion").html('<div class="alert alert-warning"><strong>Ya existe una versión con esté código.</strong></div>');
                } else {
                    $(".e_mensajeValVersion").html('');
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("keyup", "#Sol_CodigoDocumentoGestionar", function (e) {
        e.preventDefault();

        d_codigo = $("#Sol_CodigoDocumentoGestionar").val();

        $.ajax({
            type: "POST",
            url: "f_listarVersion.php",
            beforeSend: function () {
                $(".e_tablaAnterior").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".e_tablaAnterior").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    /*$("body").on("change", "#Sol_AccionDocumentoGestionar", function (e) {
     e.preventDefault();
     
     d_valor = $("#Sol_AccionDocumentoGestionar").val();
     
     if (d_valor === "Nuevo") {
     $.ajax({
     type: "POST",
     url: "f_listarVersion.php",
     beforeSend: function () {
     $(".e_tablaAnterior").html(loader());
     },
     data: {codigo: d_codigo},
     success: function (data) {
     $(".e_tablaAnterior").html(data);
     },
     error: function (er1, er2, er3) {
     console.log(er2 + "-" + er3);
     }
     });
     }
     });*/

    //Version Automatica
    $("body").on("keyup", "#Sol_CodigoDocumentoGestionar", function (e) {
        e.preventDefault();

        d_codigo = $("#Sol_CodigoDocumentoGestionar").val();
        d_version = $("#Sol_HistorialVersionGestionar").val();

        if (d_valor === "Nuevo") {
            $.ajax({
                type: "POST",
                url: "op_hallarVersion.php",
                beforeSend: function () {
                },
                data: {codigo: d_codigo, version: d_version},
                dataType: 'json',
                success: function (data) {
                    $("#Sol_HistorialVersionGestionar").val(data.valorVersion);

                },
                error: function (er1, er2, er3) {
                    console.log(er2 + "-" + er3);
                }
            });
        }
    });

    /*$("body").on("change", "#Sol_AccionDocumentoGestionar", function (e) {
     e.preventDefault();
     
     d_codigo = $("#Sol_CodigoDocumentoGestionar").val();
     d_version = $("#Sol_HistorialVersionGestionar").val();
     
     
     $.ajax({
     type: "POST",
     url: "op_hallarVersion.php",
     beforeSend: function () {
     },
     data: {codigo: d_codigo, version: d_version},
     dataType: 'json',
     success: function (data) {
     $("#Sol_HistorialVersionGestionar").val(data.valorVersion);
     
     },
     error: function (er1, er2, er3) {
     console.log(er2 + "-" + er3);
     }
     });
     
     });*/



    $("body").on("click", ".excel_Solicitudes", function (e) {
        e.preventDefault();


        d_fechaInicial = $("#filtroSolicitudes_FechaInicial").val();
        d_fechaFinal = $("#filtroSolicitudes_FechaFinal").val();
        d_estado = $("#filtroSolicitudes_Estado").val();
        d_area = $("#Sol_Area_Codigo").val();
        d_tipo = $("#filtroSolicitudes_TipoDocumento").val();
        d_busqueda = $("#d_busqueda").val();

        window.location.href = "excel_solicitudes.php?fechaInicial=" + d_fechaInicial + "&fechaFinal=" + d_fechaFinal + "&estado=" + d_estado + "&area=" + d_area + "&tipo=" + d_tipo + "" + "&bus=" + d_busqueda + "";

    });
    //Guías
    $("body").on("click", ".abrir_guia", function (e) {
        e.preventDefault();


        $("#vtn_AbrirGuia").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_definiciones.php",
            beforeSend: function () {
                $(".info_AbrirGuia").html(loader());
            },
            success: function (data) {
                $(".info_AbrirGuia").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("mouseover", ".Pir_Anima_1", function (e) {
        e.preventDefault();

        $(".Pir_Res_Anima_1").css("display", "block");
        $(".Pir_Res_Anima_2").css("display", "none");
        $(".Pir_Res_Anima_3").css("display", "none");
        $(".Pir_Res_Anima_4").css("display", "none");
        $(".Pir_Res_Anima_5").css("display", "none");

    });


    $("body").on("mouseover", ".Pir_Anima_2", function (e) {
        e.preventDefault();
        $(".Pir_Res_Anima_1").css("display", "none");
        $(".Pir_Res_Anima_2").css("display", "block");
        $(".Pir_Res_Anima_3").css("display", "none");
        $(".Pir_Res_Anima_4").css("display", "none");
        $(".Pir_Res_Anima_5").css("display", "none");


    });


    $("body").on("mouseover", ".Pir_Anima_3", function (e) {
        e.preventDefault();

        $(".Pir_Res_Anima_1").css("display", "none");
        $(".Pir_Res_Anima_2").css("display", "none");
        $(".Pir_Res_Anima_3").css("display", "block");
        $(".Pir_Res_Anima_4").css("display", "none");
        $(".Pir_Res_Anima_5").css("display", "none");

    });



    $("body").on("mouseover", ".Pir_Anima_4", function (e) {
        e.preventDefault();

        $(".Pir_Res_Anima_1").css("display", "none");
        $(".Pir_Res_Anima_2").css("display", "none");
        $(".Pir_Res_Anima_3").css("display", "none");
        $(".Pir_Res_Anima_4").css("display", "block");
        $(".Pir_Res_Anima_5").css("display", "none");

    });


    $("body").on("mouseover", ".Pir_Anima_5", function (e) {
        e.preventDefault();

        $(".Pir_Res_Anima_1").css("display", "none");
        $(".Pir_Res_Anima_2").css("display", "none");
        $(".Pir_Res_Anima_3").css("display", "none");
        $(".Pir_Res_Anima_4").css("display", "none");
        $(".Pir_Res_Anima_5").css("display", "block");

    });

    $("body").on("click", ".ejemplo_pdf", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");

        $("#vtn_VerEjemplo").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_ejemplos_pdf.php",
            beforeSend: function () {
                $(".info_VerEjemplo").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_VerEjemplo").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".Btn_GuiaReglas", function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "f_guiaReglas.php",
            beforeSend: function () {
                $(".InfoGuia_Reglas").html(loader());
            },
            success: function (data) {
                $(".InfoGuia_Reglas").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".Btn_GuiaPiramide", function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "f_abrirGuias.php",
            beforeSend: function () {
                $(".InfoGuia_Piramide").html(loader());
            },
            success: function (data) {
                $(".InfoGuia_Piramide").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".e_cargarSolicitudVerHistorial", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");
        d_codigoglobalsolucion = $(this).attr("data-cod");

        $("#vtn_SolicitudesConsultar").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_solicitudesflujoAprobacionesUsuariosConsultar.php",
            beforeSend: function () {
                $(".info_SolicitudesConsultar").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_SolicitudesConsultar").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
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

        $("#Btn_BuscarSolicitudes").click();

    });

    $("body").on("change", "#Codigo_Pla", function (e) {
        e.preventDefault();
        d_planta = $('#Codigo_Pla').val() + '-';
        d_tipo = $('#Sol_TipoDocumentoGestionar :selected').attr("data-cod") + '-';
        d_area = $('#Sol_Are').val() + '-';
        d_num = $('#Sol_CodigoDocumentoGestionarNuevo').val();
        $.ajax({
            type: "POST",
            url: "op_cargarCodigo.php",
            dataType: 'json',
            data: {planta: d_planta, tipo: d_tipo, area: d_area, num: d_num},
            success: function (data) {
                $("#f_solicitudesGestionarCrear #Sol_CodigoDocumentoGestionar").val(data.codigo);
                $("#f_solicitudesGestionarCrear #Sol_CodigoDocumentoGestionarLabel").html('<label>' + data.codigo + '</label>');
                $.ajax({
                    type: "POST",
                    url: "f_listarVersion.php",
                    beforeSend: function () {
                        $(".e_tablaAnterior").html(loader());
                    },
                    data: {codigo: data.codigo},
                    success: function (data) {
                        $(".e_tablaAnterior").html(data);
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

    $("body").on("change", "#Sol_TipoDocumentoGestionar", function (e) {
        e.preventDefault();
        d_planta = $('#Codigo_Pla').val() + '-';
        d_tipo = $('#Sol_TipoDocumentoGestionar :selected').attr("data-cod") + '-';
        d_area = $('#Sol_Are').val() + '-';
        d_num = $('#Sol_CodigoDocumentoGestionarNuevo').val();
        $.ajax({
            type: "POST",
            url: "op_cargarCodigo.php",
            dataType: 'json',
            data: {planta: d_planta, tipo: d_tipo, area: d_area, num: d_num},
            success: function (data) {
                $("#f_solicitudesGestionarCrear #Sol_CodigoDocumentoGestionar").val(data.codigo);
                $("#f_solicitudesGestionarCrear #Sol_CodigoDocumentoGestionarLabel").html('<label>' + data.codigo + '</label>');
                $.ajax({
                    type: "POST",
                    url: "f_listarVersion.php",
                    beforeSend: function () {
                        $(".e_tablaAnterior").html(loader());
                    },
                    data: {codigo: data.codigo},
                    success: function (data) {
                        $(".e_tablaAnterior").html(data);
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

    $("body").on("change", "#Sol_Are", function (e) {
        e.preventDefault();
        d_planta = $('#Codigo_Pla').val() + '-';
        d_tipo = $('#Sol_TipoDocumentoGestionar :selected').attr("data-cod") + '-';
        d_area = $('#Sol_Are').val() + '-';
        d_num = $('#Sol_CodigoDocumentoGestionarNuevo').val();
        $.ajax({
            type: "POST",
            url: "op_cargarCodigo.php",
            dataType: 'json',
            data: {planta: d_planta, tipo: d_tipo, area: d_area, num: d_num},
            success: function (data) {
                $("#f_solicitudesGestionarCrear #Sol_CodigoDocumentoGestionar").val(data.codigo);
                $("#f_solicitudesGestionarCrear #Sol_CodigoDocumentoGestionarLabel").html('<label>' + data.codigo + '</label>');
                $.ajax({
                    type: "POST",
                    url: "f_listarVersion.php",
                    beforeSend: function () {
                        $(".e_tablaAnterior").html(loader());
                    },
                    data: {codigo: data.codigo},
                    success: function (data) {
                        $(".e_tablaAnterior").html(data);
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

    $("body").on("keyup", "#Sol_CodigoDocumentoGestionarNuevo", function (e) {
        e.preventDefault();
        d_planta = $('#Codigo_Pla').val() + '-';
        d_tipo = $('#Sol_TipoDocumentoGestionar :selected').attr("data-cod") + '-';
        d_area = $('#Sol_Are').val() + '-';
        d_num = $('#Sol_CodigoDocumentoGestionarNuevo').val();
        $.ajax({
            type: "POST",
            url: "op_cargarCodigo.php",
            dataType: 'json',
            data: {planta: d_planta, tipo: d_tipo, area: d_area, num: d_num},
            success: function (data) {
                $("#f_solicitudesGestionarCrear #Sol_CodigoDocumentoGestionar").val(data.codigo);
                $("#f_solicitudesGestionarCrear #Sol_CodigoDocumentoGestionarLabel").html('<label>' + data.codigo + '</label>');
                d_codigo = $("#Sol_CodigoDocumentoGestionar").val();
                d_version = $("#Sol_HistorialVersionGestionar").val();

                $.ajax({
                    type: "POST",
                    url: "op_hallarVersion.php",
                    beforeSend: function () {
                    },
                    data: {codigo: d_codigo, version: d_version},
                    dataType: 'json',
                    success: function (data) {
                        $("#Sol_HistorialVersionGestionar").val(data.valorVersion);
                    },
                    error: function (er1, er2, er3) {
                        console.log(er2 + "-" + er3);
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "f_listarVersion.php",
                    beforeSend: function () {
                        $(".e_tablaAnterior").html(loader());
                    },
                    data: {codigo: data.codigo},
                    success: function (data) {
                        $(".e_tablaAnterior").html(data);
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
    $("body").on("change", ".Inp_SeleccionarTodosOperarios", function (e) {
        e.preventDefault();

        if ($(this).prop("checked") == true) {
            $(".C_Capacitado").prop("checked", true);
        } else {
            $(".C_Capacitado").prop("checked", false);
        }

    });

    $("body").on("click", "#Btn_AdjuntoPrestamoForm", function (e) {
        e.preventDefault();

        d_mcodigo = $("#Sol_CodigoActualSolicitudProcesando").val();
        d_archivo1 = $("#i_AdjuntoA1").val();
        d_archivo2 = $("#i_AdjuntoA2").val();
        d_archivo3 = $("#i_AdjuntoA3").val();
        d_archivo4 = $("#i_AdjuntoA4").val();
        d_archivo5 = $("#i_AdjuntoA5").val();
        d_codigoSolicitud = $("#Sol_CodigoActualSolicitudProcesando").val();

        $.ajax({
            type: "POST",
            url: "op_capacitacionesAdjuntos.php",
            beforeSend: function () {
                //bloquearFormulario("f_adjuntoAntes");
                $("#Btn_AdjuntoPrestamoForm").hide();
            },
            complete: function () {
                //desbloquearFormulario("f_adjuntoAntes");
                $("#Btn_AdjuntoPrestamoForm").show();
            },
            data: {archivo1: d_archivo1, archivo2: d_archivo2, archivo3: d_archivo3, archivo4: d_archivo4, archivo5: d_archivo5, codigo: d_mcodigo},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {

                    //Carga el listar de Nuevo
                    $.ajax({
                        type: "POST",
                        url: "f_listarAdjuntosDonaciones.php",
                        beforeSend: function () {
                            $(".e_cargarDatosAdjuntos").html(loader());
                        },
                        data: {mcodigo: d_mcodigo, tipo: 5},
                        success: function (data) {
                            $(".e_cargarDatosAdjuntos").html(data);
                            //  d_codigo = $(this).attr("data-cod");

                            $("#vtn_SolicitudesGestionar").modal('hide');




                            /*   $.ajax({
                             type: "POST",
                             url: "f_solicitudesflujoAprobacionesUsuarios.php",
                             beforeSend: function () {
                             $(".info_SolicitudesGestionar").html(loader());
                             },
                             data: {codigo: d_codigo},
                             success: function (data) {
                             $("#vtn_SolicitudesGestionar").modal({backdrop: 'static'});
                             $(".info_SolicitudesGestionar").html(data);
                             },
                             error: function (er1, er2, er3) {
                             console.log(er2 + "-" + er3);
                             }
                             }); */
                        },
                        error: function (er1, er2, er3) {
                            console.log(er2 + "-" + er3);
                        }
                    });

                } else {
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });
    $("body").on("click", ".e_VerAdjuntoSug", function (e) {
        e.preventDefault();
        $("#vtn_ImagenVer").modal({backdrop: 'static'});
        d_codigo = $(this).attr('data-cod');
        $.ajax({
            type: "POST",
            url: "f_verAdjunto.php",
            beforeSend: function () {
                $(".info_ImagenVer").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_ImagenVer").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });
    $("body").on("click", ".e_EliminarAdjunto", function (e) {
        e.preventDefault();

        d_mcodigo = $("#Sol_CodigoActualSolicitudProcesando").val();
        d_codigo = $(this).attr('data-cod');

        $.ajax({
            type: "POST",
            url: "op_eliminarAdjunto.php",
            beforeSend: function () {
                bloquearFormulario("f_prestamosCrear");
                $("#Btn_PrestamosCrearForm").hide();
            },
            complete: function () {
                desbloquearFormulario("f_prestamosCrear");
                $("#Btn_PrestamosCrearForm").show();
            },
            data: {codajunto: d_codigo, tipo: 5},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    //Carga el listar de Nuevo
                    $.ajax({
                        type: "POST",
                        url: "f_listarAdjuntosDonaciones.php",
                        beforeSend: function () {
                            $(".e_cargarDatosAdjuntos").html(loader());
                        },
                        data: {mcodigo: d_mcodigo, tipo: 5},
                        success: function (data) {
                            $(".e_cargarDatosAdjuntos").html(data);
                        },
                        error: function (er1, er2, er3) {
                            console.log(er2 + "-" + er3);
                        }
                    });

                } else if (rs.mensaje == "No") {
                    $(".cargarObligatorio").html('<div class="alert alert-danger">Debe mantener al menos 1 archivo adjunto</div>');
                } else {
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("#btn_excelSolicitudes").click(function (event) {
        $("#input_resultadoSolicitudes").val($("<div>").append($("#tbl_Solicitudes").eq(0).clone()).html());
        $("#f_exportarSolicitudes").submit();
    });

    /*
     $("body").on("ready", "#Sol_AccionDocumentoGestionar", function (e) {
     e.preventDefault();
     d_planta = $('#Codigo_Pla').val() + '-';
     d_tipo = $('#Sol_TipoDocumentoGestionar').attr("data-cod") + '-';
     d_area = $('#Sol_Are').val() + '-';
     d_num = $('#Sol_CodigoDocumentoGestionarNuevo').val();
     
     if (d_valor == "Nuevo") {
     $.ajax({
     type: "POST",
     url: "op_cargarCodigo.php",
     dataType: 'json',
     data: {planta: d_planta, tipo: d_tipo, area: d_area, num: d_num},
     success: function (data) {
     $("#f_solicitudesGestionarCrear #Sol_CodigoDocumentoGestionar").val(data.codigo);
     $("#f_solicitudesGestionarCrear #Sol_CodigoDocumentoGestionarLabel").html('<label>' + data.codigo + '</label>');
     d_codigo = $("#Sol_CodigoDocumentoGestionar").val();
     d_version = $("#Sol_HistorialVersionGestionar").val();
     
     $.ajax({
     type: "POST",
     url: "op_hallarVersion.php",
     beforeSend: function () {
     },
     data: {codigo: d_codigo, version: d_version},
     dataType: 'json',
     success: function (data) {
     $("#Sol_HistorialVersionGestionar").val(data.valorVersion);
     },
     error: function (er1, er2, er3) {
     console.log(er2 + "-" + er3);
     }
     });
     $.ajax({
     type: "POST",
     url: "f_listarVersion.php",
     beforeSend: function () {
     $(".e_tablaAnterior").html(loader());
     },
     data: {codigo: data.codigo},
     success: function (data) {
     $(".e_tablaAnterior").html(data);
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
     }
     });
     */

    /*$("body").on("change", "#Sol_AccionDocumentoGestionar", function (e) {
     e.preventDefault();
     
     d_valor = $("#Sol_AccionDocumentoGestionar").val();
     
     if (d_valor === "Nuevo") {
     $.ajax({
     type: "POST",
     url: "f_listarVersion.php",
     beforeSend: function () {
     $(".e_tablaAnterior").html(loader());
     },
     data: {codigo: d_codigo},
     success: function (data) {
     $(".e_tablaAnterior").html(data);
     },
     error: function (er1, er2, er3) {
     console.log(er2 + "-" + er3);
     }
     });
     }
     });*/
});