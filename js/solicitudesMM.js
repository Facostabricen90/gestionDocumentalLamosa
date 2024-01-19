$(document).ready(function (e) {
    $('#FiltroSolmm_Pais').multiselect({
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
    $("body").on("click", "#Btn_BuscarSolicitudesMM", function (e) {
        e.preventDefault();

        d_planta = $("#FiltroSolmm_Planta").val();
        d_fechaInicial = $("#filtroSolicitudesMM_FechaInicial").val();
        d_fechaFinal = $("#filtroSolicitudesMM_FechaFinal").val();
        d_estado = $("#filtroSolicitudesMM_Estado").val();
        d_area = $("#SolMM_Area_Nombres").val();

        $.ajax({
            type: "POST",
            url: "f_solicitudesMMListar.php",
            beforeSend: function () {
                $(".info_solicitudesMMListar").html(loader());
            },
            data: {fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, estado: d_estado, area: d_area, planta: d_planta},
            success: function (data) {
                $(".info_solicitudesMMListar").html(data);
                $("#tbl_SolicitudesMM").tablesorter();

            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });
    $("body").on("change", "#FiltroSolmm_Pais", function (e) {
        e.preventDefault();

        d_pais = $(this).val();
        d_modulo = $(this).attr('data-mod');
        $.ajax({
            type: "POST",
            url: "f_cargarFiltroPlantas.php",
            beforeSend: function () {
                $(".e_cargarFiltroSolmmPlantas").html(loader());
            },
            data: {d_pais: d_pais, modulo: d_modulo},
            success: function (data) {
                $(".e_cargarFiltroSolmmPlantas").html(data);
                $('#FiltroSolmm_Planta').multiselect({
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
    $("body").on("click", "#Btn_SolicitudesMMCrear", function (e) {
        e.preventDefault();

        $("#vtn_SolicitudesMMCrear").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_solicitudesMMCrear.php",
            beforeSend: function () {
                $(".info_SolicitudesMMCrear").html(loader());
            },
            success: function (data) {
                $(".info_SolicitudesMMCrear").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("submit", "#f_solicitudesMMCrear", function (e) {
        e.preventDefault();

        d_area = $("#f_solicitudesMMCrear #SolMM_Area_Codigo").val();
        d_tipoDocumento = $("#f_solicitudesMMCrear #SolMM_TipoDocumento").val();
        d_observaciones = $("#f_solicitudesMMCrear #SolMM_Observaciones").val();
        d_archivo = $("#f_solicitudesMMCrear #i_SolMM_FormatoSolicitud").val();
        d_accionDocumento = $("#f_solicitudesMMCrear #SolMM_AccionDocumento").val();

        d_codigoDocumento = $("#f_solicitudesMMCrear #SolMM_CodigoDocumento").val();
        d_nombreDocumento = $("#f_solicitudesMMCrear #SolMM_NombreDocumento").val();
        d_historialVersion = $("#f_solicitudesMMCrear #SolMM_HistorialVersion").val();
        d_tema = $("#f_solicitudesMMCrear #SolMM_Tema").val();

        if (d_accionDocumento == "Nuevo" || (d_accionDocumento == "Actualización" && d_archivo != "")) {
            $.ajax({
                type: "POST",
                url: "op_solicitudesMMCrear.php",
                beforeSend: function () {
                    bloquearFormulario("f_solicitudesMMCrear");
                    $("#Btn_SolicitudesMMCrearForm").hide();
                    $("#vtn_SolicitudesMMNotificacionesCrear").modal({backdrop: 'static'});
                    $(".info_SolicitudeMMsNotificacionesCrear").html(loader() + "<br>Enviando Correos");
                    $("#Btn_SolicitudesMMNotificacionesCrear").hide();
                },
                complete: function () {
                    desbloquearFormulario("f_solicitudesMMCrear");
                    $("#Btn_SolicitudesMMCrearForm").show();
                    $("#Btn_SolicitudesMMNotificacionesCrear").show();
                },
                data: {area: d_area, tipoDocumento: d_tipoDocumento, observaciones: d_observaciones, archivo: d_archivo, accionDocumento: d_accionDocumento, codigoDocumento: d_codigoDocumento, nombreDocumento: d_nombreDocumento, historialVersion: d_historialVersion, tema: d_tema},
                dataType: 'json',
                success: function (rs) {
                    if (rs.mensaje == "OK") {
                        //window.location.href = "https://sugerencias.lamosa.com/correos/gestiondocumental/op_gestiondocumental.php?paso=1" + "&tipoDocumento=" + d_tipoDocumento + "&tema=" + d_tema + "&area=" + d_area + "&observaciones=" + d_observaciones + "&planta=" + rs.planta + "&codigo=" + d_codigoDocumento;
                        $(".info_SolicitudesMMNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
                    } else {
                        $("#vtn_SolicitudesMMNotificacionesCrear").modal({backdrop: 'static'});
                        $(".info_SolicitudesMMNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
                        $("#Btn_SolicitudesMMCrearForm").show();
                        mensaje('2', rs.mensaje);
                    }
                },
                error: function (er1, er2, er3) {
                    console.log(er2 + "-" + er3);
                }
            });
        } else {
            $(".Men_ObliCargarArcSoliIniMM").html('<div class="alert alert-danger"><strong>Él Documento es Obligatorio Cargarlo para Continuar su Flujo</strong></div>');
        }

    });

    $("body").on("click", "#Btn_SolicitudesMMNotificacionesCrear", function (e) {
        e.preventDefault();

        window.location.href = "fm_solicitudesMM.php";

    });

    $("body").on("click", ".e_cargarSolicitudMMGestion", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");

        $("#vtn_SolicitudesMMGestionar").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_solicitudesMMflujoAprobacionesUsuarios.php",
            beforeSend: function () {
                $(".info_SolicitudesMMGestionar").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_SolicitudesMMGestionar").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("submit", "#f_solicitudesMMGestionarCrear", function (e) {
        e.preventDefault();

        d_paso = $("#f_solicitudesMMGestionarCrear #SolMM_PasoActual").val();
        d_codigo = $("#f_solicitudesMMGestionarCrear #SolMM_CodigoActualSolicitudProcesando").val();

        if (d_paso == "2") {
            d_calificacion = $("#f_solicitudesMMGestionarCrear #HistF_CalificacionRevisionJefeArea").val();
            d_observaciones = $("#f_solicitudesMMGestionarCrear #HistF_ObservacionRevisionJefeArea").val();
            d_archivo = $("#f_solicitudesMMGestionarCrear #i_SolMM_FormatoGestionarRevisionJefeArea1").val();

            $.ajax({
                type: "POST",
                url: "op_solicitudMMFlujoAprobacionesPasosCrear.php",
                beforeSend: function () {
                    bloquearFormulario("f_solicitudesMMGestionarCrear");
                    $("#Btn_SolicitudesMMCrearForm").hide();
                    $("#vtn_SolicitudesMMNotificacionesAprobar").modal({backdrop: 'static'});
                    $(".info_SolicitudesMMNotificacionesAprobar").html(loader() + "<br>Enviando Correos");
                    $("#Btn_SolicitudesMMNotificacionesAprobar").hide();
                },
                complete: function () {
                    desbloquearFormulario("f_solicitudesMMGestionarCrear");
                    $("#Btn_SolicitudesMMNotificacionesAprobar").show();
                },
                data: {codigo: d_codigo, paso: d_paso, calificacion: d_calificacion, observaciones: d_observaciones, archivo: d_archivo},
                dataType: 'json',
                success: function (rs) {
                    if (rs.mensaje == "OK") {
                        //window.location.href = "https://sugerencias.lamosa.com/correos/gestiondocumental/op_gestiondocumental.php?codigo=" + d_codigo + "&paso=" + d_paso + "&calificacion=" + d_calificacion + "&observaciones=" + d_observaciones +"&planta=" + rs.planta + "&area=" + rs.areas;
                        $(".info_SolicitudesMMNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra22 verde"></span><h3>Solicitud Gestionada Correctamente.</h3>');
                        $("#Btn_SolicitudesMMCrearForm").show();

                    } else {
                        $("#vtn_SolicitudesMMNotificacionesAprobar").modal({backdrop: 'static'});
                        $(".info_SolicitudesMMNotificacionesAprobar").html('<span class="glyphicon glyphicon-remove letra22 rojo"></span><h3>Solicitud NO Gestionada</h3>');
                        $("#Btn_SolicitudesMMCrearForm").show();
                        mensaje('2', rs.mensaje);
                    }
                },
                error: function (er1, er2, er3) {
                    console.log(er2 + "-" + er3);
                }
            });
        }

        if (d_paso == "3") {
            d_calificacion = $("#f_solicitudesMMGestionarCrear #HistF_CalificacionRevisionEHS").val();
            d_observaciones = $("#f_solicitudesMMGestionarCrear #HistF_ObservacionRevisionEHS").val();
            d_archivo = $("#f_solicitudesMMGestionarCrear #i_SolMM_FormatoGestionarRevisionEHS1").val();

            $.ajax({
                type: "POST",
                url: "op_solicitudMMFlujoAprobacionesPasosCrear.php",
                beforeSend: function () {
                    bloquearFormulario("f_solicitudesMMGestionarCrear");
                    $("#Btn_SolicitudesMMCrearForm").hide();
                    $("#vtn_SolicitudesMMNotificacionesAprobar").modal({backdrop: 'static'});
                    $(".info_SolicitudesMMNotificacionesAprobar").html(loader() + "<br>Enviando Correos");
                    $("#Btn_SolicitudesMMNotificacionesAprobar").hide();
                },
                complete: function () {
                    desbloquearFormulario("f_solicitudesMMGestionarCrear");
                    $("#Btn_SolicitudesMMNotificacionesAprobar").show();
                },
                data: {codigo: d_codigo, paso: d_paso, calificacion: d_calificacion, observaciones: d_observaciones, archivo: d_archivo},
                dataType: 'json',
                success: function (rs) {
                    if (rs.mensaje == "OK") {
                        //window.location.href = "https://sugerencias.lamosa.com/correos/gestiondocumental/op_gestiondocumental.php?codigo=" + d_codigo + "&paso=" + d_paso + "&calificacion=" + d_calificacion + "&observaciones=" + d_observaciones +"&planta=" + rs.planta + "&area=" + rs.areas;
                        $(".info_SolicitudesMMNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra22 verde"></span><h3>Solicitud Gestionada Correctamente.</h3>');
                        $("#Btn_SolicitudesMMCrearForm").show();

                    } else {
                        $("#vtn_SolicitudesMMNotificacionesAprobar").modal({backdrop: 'static'});
                        $(".info_SolicitudesMMNotificacionesAprobar").html('<span class="glyphicon glyphicon-remove letra22 rojo"></span><h3>Solicitud NO Gestionada</h3>');
                        $("#Btn_SolicitudesMMCrearForm").show();
                        mensaje('2', rs.mensaje);
                    }
                },
                error: function (er1, er2, er3) {
                    console.log(er2 + "-" + er3);
                }
            });
        }

        if (d_paso == "4") {
            d_observaciones = $("#f_solicitudesMMGestionarCrear #HistF_ObservacionGestionarDocumentoAjustes").val();
            d_archivo = $("#f_solicitudesMMGestionarCrear #i_SolMM_FormatoGestionarAjustes").val();

            if (d_archivo != "") {
                $.ajax({
                    type: "POST",
                    url: "op_solicitudMMFlujoAprobacionesPasosCrear.php",
                    beforeSend: function () {
                        bloquearFormulario("f_solicitudesMMGestionarCrear");
                        $("#Btn_SolicitudesMMCrearForm").hide();
                        $("#vtn_SolicitudesMMNotificacionesAprobar").modal({backdrop: 'static'});
                        $(".info_SolicitudesMMNotificacionesAprobar").html(loader() + "<br>Enviando Correos");
                        $("#Btn_SolicitudesMMNotificacionesAprobar").hide();
                    },
                    complete: function () {
                        desbloquearFormulario("f_solicitudesMMGestionarCrear");
                        $("#Btn_SolicitudesMMNotificacionesAprobar").show();
                    },
                    data: {codigo: d_codigo, paso: d_paso, observaciones: d_observaciones, archivo: d_archivo},
                    dataType: 'json',
                    success: function (rs) {
                        if (rs.mensaje == "OK") {
                            //window.location.href = "https://sugerencias.lamosa.com/correos/gestiondocumental/op_gestiondocumental.php?codigo=" + d_codigo + "&paso=" + d_paso + "&observaciones=" + d_observaciones +"&planta=" + rs.planta + "&area=" + rs.areas;
                            $(".info_SolicitudesMMNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra22 verde"></span><h3>Documento Ajustado Correctamente.</h3>');
                            $("#Btn_SolicitudesMMCrearForm").show();
                        } else {
                            $("#vtn_SolicitudesMMNotificacionesAprobar").modal({backdrop: 'static'});
                            $(".info_SolicitudesMMNotificacionesAprobar").html('<span class="glyphicon glyphicon-remove letra22 rojo"></span><h3>Documento NO Ajustado Correctamente.</h3>');
                            $("#Btn_SolicitudesMMCrearForm").show();
                            mensaje('2', rs.mensaje);
                        }
                    },
                    error: function (er1, er2, er3) {
                        console.log(er2 + "-" + er3);
                    }
                });
            } else {
                $(".Men_ObliCargarArcAjustesMM").html('<div class="alert alert-danger"><strong>Él Documento Ajustado es Obligatorio Cargarlo para Continuar su Flujo</strong></div>');
            }
        }

        if (d_paso == "5") {
            d_observaciones = $("#f_solicitudesMMGestionarCrear #HistF_ObservacionGestionarDocumentoRevisionJefeArea2").val();
            d_archivo = $("#f_solicitudesMMGestionarCrear #i_SolMM_FormatoGestionarRevisionJefeArea2").val();

            $.ajax({
                type: "POST",
                url: "op_solicitudMMFlujoAprobacionesPasosCrear.php",
                beforeSend: function () {
                    bloquearFormulario("f_solicitudesMMGestionarCrear");
                    $("#Btn_SolicitudesMMCrearForm").hide();
                    $("#vtn_SolicitudesMMNotificacionesAprobar").modal({backdrop: 'static'});
                    $(".info_SolicitudesMMNotificacionesAprobar").html(loader() + "<br>Enviando Correos");
                    $("#Btn_SolicitudesMMNotificacionesAprobar").hide();
                },
                complete: function () {
                    desbloquearFormulario("f_solicitudesMMGestionarCrear");
                    $("#Btn_SolicitudesMMNotificacionesAprobar").show();
                },
                data: {codigo: d_codigo, paso: d_paso, observaciones: d_observaciones, archivo: d_archivo},
                dataType: 'json',
                success: function (rs) {
                    if (rs.mensaje == "OK") {
                        //window.location.href = "https://sugerencias.lamosa.com/correos/gestiondocumental/op_gestiondocumental.php?codigo=" + d_codigo + "&paso=" + d_paso + "&observaciones=" + d_observaciones +"&planta=" + rs.planta + "&area=" + rs.areas;
                        $(".info_SolicitudesMMNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra22 verde"></span><h3>Documento Ajustado Correctamente.</h3>');
                        $("#Btn_SolicitudesMMCrearForm").show();
                    } else {
                        $("#vtn_SolicitudesMMNotificacionesAprobar").modal({backdrop: 'static'});
                        $(".info_SolicitudesMMNotificacionesAprobar").html('<span class="glyphicon glyphicon-remove letra22 rojo"></span><h3>Documento NO Ajustado Correctamente.</h3>');
                        $("#Btn_SolicitudesMMCrearForm").show();
                        mensaje('2', rs.mensaje);
                    }
                },
                error: function (er1, er2, er3) {
                    console.log(er2 + "-" + er3);
                }
            });

        }

        if (d_paso == "6") {
            d_observaciones = $("#f_solicitudesMMGestionarCrear #HistF_ObservacionGestionarDocumentoRevisionEHS2").val();
            d_archivo = $("#f_solicitudesMMGestionarCrear #i_SolMM_FormatoGestionarRevisionEHS2").val();

            $.ajax({
                type: "POST",
                url: "op_solicitudMMFlujoAprobacionesPasosCrear.php",
                beforeSend: function () {
                    bloquearFormulario("f_solicitudesMMGestionarCrear");
                    $("#Btn_SolicitudesMMCrearForm").hide();
                    $("#vtn_SolicitudesMMNotificacionesAprobar").modal({backdrop: 'static'});
                    $(".info_SolicitudesMMNotificacionesAprobar").html(loader() + "<br>Enviando Correos");
                    $("#Btn_SolicitudesMMNotificacionesAprobar").hide();
                },
                complete: function () {
                    desbloquearFormulario("f_solicitudesMMGestionarCrear");
                    $("#Btn_SolicitudesMMNotificacionesAprobar").show();
                },
                data: {codigo: d_codigo, paso: d_paso, observaciones: d_observaciones, archivo: d_archivo},
                dataType: 'json',
                success: function (rs) {
                    if (rs.mensaje == "OK") {
                        //window.location.href = "https://sugerencias.lamosa.com/correos/gestiondocumental/op_gestiondocumental.php?codigo=" + d_codigo + "&paso=" + d_paso + "&observaciones=" + d_observaciones +"&planta=" + rs.planta + "&area=" + rs.areas;
                        $(".info_SolicitudesMMNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra22 verde"></span><h3>Documento Ajustado Correctamente.</h3>');
                        $("#Btn_SolicitudesMMCrearForm").show();
                    } else {
                        $("#vtn_SolicitudesMMNotificacionesAprobar").modal({backdrop: 'static'});
                        $(".info_SolicitudesMMNotificacionesAprobar").html('<span class="glyphicon glyphicon-remove letra22 rojo"></span><h3>Documento NO Ajustado Correctamente.</h3>');
                        $("#Btn_SolicitudesMMCrearForm").show();
                        mensaje('2', rs.mensaje);
                    }
                },
                error: function (er1, er2, er3) {
                    console.log(er2 + "-" + er3);
                }
            });

        }

        if (d_paso == "7") {
            d_observaciones = $("#f_solicitudesMMGestionarCrear #HistF_ObservacionGestionarSubirPDF").val();
            d_archivo = $("#f_solicitudesMMGestionarCrear #i_SolMM_FormatoGestionarSubirPDF").val();

            $.ajax({
                type: "POST",
                url: "op_solicitudMMFlujoAprobacionesPasosCrear.php",
                beforeSend: function () {
                    bloquearFormulario("f_solicitudesMMGestionarCrear");
                    $("#Btn_SolicitudesMMCrearForm").hide();
                    $("#vtn_SolicitudesMMNotificacionesAprobar").modal({backdrop: 'static'});
                    $(".info_SolicitudesMMNotificacionesAprobar").html(loader() + "<br>Enviando Correos");
                    $("#Btn_SolicitudesMMNotificacionesAprobar").hide();
                },
                complete: function () {
                    desbloquearFormulario("f_solicitudesMMGestionarCrear");
                    $("#Btn_SolicitudesMMNotificacionesAprobar").show();
                },
                data: {codigo: d_codigo, paso: d_paso, observaciones: d_observaciones, archivo: d_archivo},
                dataType: 'json',
                success: function (rs) {
                    if (rs.mensaje == "OK") {
                        //window.location.href = "https://sugerencias.lamosa.com/correos/gestiondocumental/op_gestiondocumental.php?codigo=" + d_codigo + "&paso=" + d_paso + "&observaciones=" + d_observaciones +"&planta=" + rs.planta + "&area=" + rs.areas;
                        $(".info_SolicitudesMMNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra22 verde"></span><h3>Documento Ajustado Correctamente.</h3>');
                        $("#Btn_SolicitudesMMCrearForm").show();
                    } else {
                        $("#vtn_SolicitudesMMNotificacionesAprobar").modal({backdrop: 'static'});
                        $(".info_SolicitudesMMNotificacionesAprobar").html('<span class="glyphicon glyphicon-remove letra22 rojo"></span><h3>Documento NO Ajustado Correctamente.</h3>');
                        $("#Btn_SolicitudesMMCrearForm").show();
                        mensaje('2', rs.mensaje);
                    }
                },
                error: function (er1, er2, er3) {
                    console.log(er2 + "-" + er3);
                }
            });

        }

        if (d_paso == "8") {
            d_observaciones = $("#f_solicitudesMMGestionarCrear #HistF_ObservacionGestionarRevisionMMDivulgacion").val();

            $.ajax({
                type: "POST",
                url: "op_solicitudMMFlujoAprobacionesPasosCrear.php",
                beforeSend: function () {
                    bloquearFormulario("f_solicitudesMMGestionarCrear");
                    $("#Btn_SolicitudesMMCrearForm").hide();
                    $("#vtn_SolicitudesMMNotificacionesAprobar").modal({backdrop: 'static'});
                    $(".info_SolicitudesMMNotificacionesAprobar").html(loader() + "<br>Enviando Correos");
                    $("#Btn_SolicitudesMMNotificacionesAprobar").hide();
                },
                complete: function () {
                    desbloquearFormulario("f_solicitudesMMGestionarCrear");
                    $("#Btn_SolicitudesMMNotificacionesAprobar").show();
                },
                data: {codigo: d_codigo, paso: d_paso, observaciones: d_observaciones},
                dataType: 'json',
                success: function (rs) {
                    if (rs.mensaje == "OK") {
                        //window.location.href = "https://sugerencias.lamosa.com/correos/gestiondocumental/op_gestiondocumental.php?codigo=" + d_codigo + "&paso=" + d_paso + "&observaciones=" + d_observaciones +"&planta=" + rs.planta + "&area=" + rs.areas;
                        $(".info_SolicitudesMMNotificacionesAprobar").html('<span class="glyphicon glyphicon-ok letra22 verde"></span><h3>Documento Plublicado Correctamente.</h3>');
                        $("#Btn_SolicitudesMMCrearForm").show();
                    } else {
                        $("#vtn_SolicitudesMMNotificacionesAprobar").modal({backdrop: 'static'});
                        $(".info_SolicitudesMMNotificacionesAprobar").html('<span class="glyphicon glyphicon-remove letra22 rojo"></span><h3>Documento NO Plublicado Correctamente.</h3>');
                        $("#Btn_SolicitudesMMCrearForm").show();
                        mensaje('2', rs.mensaje);
                    }
                },
                error: function (er1, er2, er3) {
                    console.log(er2 + "-" + er3);
                }
            });

        }

    });

    $("body").on("click", "#Btn_SolicitudesMMNotificacionesAprobar", function (e) {
        e.preventDefault();
        $("#vtn_SolicitudesMMGestionar").modal('hide');
        $("#vtn_SolicitudesMMNotificacionesAprobar").modal('hide');
        $("#Btn_BuscarSolicitudesMM").click();

    });

    $("body").on("click", ".e_cargarCapacitacionesSolicitudesMM", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");

        $("#vtn_CapacitacionesMMOperarios").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_capacitacionesOperariosMMCrear.php",
            beforeSend: function () {
                $(".info_CapacitacionesMMOperarios").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_CapacitacionesMMOperarios").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".e_guardarCapacitacionesMasivasMM", function (e) {
        e.preventDefault();

        d_num = $(this).attr("data-num");
        d_codigo = $(this).attr("data-cod");
        d_fecha = $("#CapOMM_Fecha").val();
        d_hora = $("#CapOMM_HorasCapacitacion").val();

        d_lista1 = [];
        d_lista2 = [];
        d_lista3 = [];
        d_lista4 = [];
        d_lista5 = [];
        d_lista6 = [];

        cont = 0;
        for (a = 0; a < d_num; a++) {
            d_lista1[cont] = $(".CMM_Capacitado" + a).prop("checked");
            d_lista2[cont] = $(".CMM_Novedades" + a).prop("checked");
            d_lista3[cont] = $(".CMM_Observaciones" + a).val();
            d_lista4[cont] = $(".CMM_CodigoOperario" + a).val();
            d_lista5[cont] = $(".CMM_Accion" + a).val();
            d_lista6[cont] = $(".CMM_CodigoCapacitacion" + a).val();
            cont++;
        }

        d_nume = cont;

        $.ajax({
            type: "POST",
            url: "op_capacitacionesOperariosCrear.php",
            beforeSend: function () {
                $(".e_guardarCapacitacionesMasivasMM").hide();
            },
            complete: function () {
                $(".e_guardarCapacitacionesMasivasMM").show();
            },
            data: {codigo: d_codigo, lista1: d_lista1, lista2: d_lista2, lista3: d_lista3, lista4: d_lista4, lista5: d_lista5, lista6: d_lista6, num: d_nume, fecha: d_fecha, hora: d_hora},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_CapacitacionesMMOperarios").modal('hide');

                    $.ajax({
                        type: "POST",
                        url: "f_solicitudesMMflujoAprobacionesUsuarios.php",
                        beforeSend: function () {
                            $(".info_SolicitudesMMGestionar").html(loader());
                        },
                        data: {codigo: d_codigo},
                        success: function (data) {
                            $(".info_SolicitudesMMGestionar").html(data);
                        },
                        error: function (er1, er2, er3) {
                            console.log(er2 + "-" + er3);
                        }
                    });
                } else {
                    $(".e_guardarCapacitacionesMasivasMM").show();
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".e_cargarSolicitudMMVerHistorial", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");

        $("#vtn_SolicitudesMMConsultar").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_solicitudesMMflujoAprobacionesUsuariosConsultar.php",
            beforeSend: function () {
                $(".info_SolicitudesMMConsultar").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_SolicitudesMMConsultar").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("click", ".e_cargarSolicitudGestionAdminMMAct", function (e) {
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

    $("body").on("click", ".excel_SolicitudesMM", function (e) {
        e.preventDefault();

        d_fechaInicial = $("#filtroSolicitudesMM_FechaInicial").val();
        d_fechaFinal = $("#filtroSolicitudesMM_FechaFinal").val();
        d_estado = $("#filtroSolicitudesMM_Estado").val();
        d_area = $("#SolMM_Area_Codigo").val();

        window.location.href = "excel_solicitudesMM.php?fechaInicial=" + d_fechaInicial + "&fechaFinal=" + d_fechaFinal + "&estado=" + d_estado + "&area=" + d_area + "";

    });


    $("#btn_excelSolicitudesmm").click(function (event) {
        $("#input_resultadoSolicitudesmm").val($("<div>").append($("#tbl_Cicloexpmm").eq(0).clone()).html());
        $("#f_exportarSolicitudesmm").submit();
    });
});