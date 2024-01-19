$(document).ready(function (e) {
    $('#FiltroCatDocInf_Pais').multiselect({
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

    $('#FiltroCatDocInf_PaisUsuarios').multiselect({
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

    $("body").on("click", "#Btn_BuscarCatalogoDocumentos", function (e) {
        e.preventDefault();

        d_planta = $("#FiltroCatDocInf_Planta").val();
//    d_fechaIni = $("#filtroCatalogoDocumentos_FechaIni").val();
//    d_fechaFin = $("#filtroCatalogoDocumentos_FechaFin").val();

        $.ajax({
            type: "POST",
            url: "f_informeCatalogoDocumentos.php",
            beforeSend: function () {
                $(".e_CargarDatosCatalogoDocumentos").html(loader());
            },
            data: {planta: d_planta},
            success: function (data) {
                if (d_planta != null) {
                    $(".e_CargarDatosCatalogoDocumentos").html(data);
                }else{
                    alert("Selecciona el pais y la planta que deseas consultar");
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("change", "#FiltroCatDocInf_Pais", function (e) {
        e.preventDefault();
        d_pais = $(this).val();
        d_modulo = $(this).attr('data-mod');
        $.ajax({
            type: "POST",
            url: "f_cargarFiltroPlantas.php",
            beforeSend: function () {
                $(".e_cargarFiltroCatDocInfPlantas").html(loader());
            },
            data: {d_pais: d_pais, modulo: d_modulo},
            success: function (data) {
                $(".e_cargarFiltroCatDocInfPlantas").html(data);
                $('#FiltroCatDocInf_Planta').multiselect({
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

    $("body").on("change", "#FiltroCatDocInf_PaisUsuarios", function (e) {
        e.preventDefault();
        d_pais = $(this).val();
        d_modulo = $(this).attr('data-mod');
        $.ajax({
            type: "POST",
            url: "f_cargarFiltroPlantas.php",
            beforeSend: function () {
                $(".e_cargarFiltroCatDocInfPlantasUsuarios").html(loader());
            },
            data: {d_pais: d_pais, modulo: d_modulo},
            success: function (data) {
                $(".e_cargarFiltroCatDocInfPlantasUsuarios").html(data);
                $('#FiltroCatDocInf_PlantaUsuarios').multiselect({
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

    $("body").on("click", ".e_CargarCicloDocumental", function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "f_informeCicloDocumental.php",
            beforeSend: function () {
                $(".e_CargarDatosCicloDocumental").html(loader());
            },
            data: {},
            success: function (data) {
                $(".e_CargarDatosCicloDocumental").html(data);
                $('#FiltroCatDocInf_Pais').multiselect({
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

                $('#FiltroCatDocInf_Planta').multiselect({
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

    $("body").on("click", "#Btn_BuscarCicloDocumentalConsolidado", function (e) {
        e.preventDefault();
        d_fechaIni = $("#filtroCicloDocumental_FechaIni").val();
        d_fechaFin = $("#filtroCicloDocumental_FechaFin").val();
        d_planta = $("#FiltroCatDocInf_Planta").val();
        
            $.ajax({
                type: "POST",
                url: "f_informeCicloDocumentalListar.php",
                beforeSend: function () {
                    $(".e_CargarListaCicloDocumentalConsolidado").html(loader());
                },
                data: {fechaIni: d_fechaIni, fechaFin: d_fechaFin, planta: d_planta},
                success: function (data) {
                    if (d_planta != null) {
                    $(".e_CargarListaCicloDocumentalConsolidado").html(data);
                }else{
                    alert("Selecciona el pais y la planta que deseas consultar");
                }
                },
                error: function (er1, er2, er3) {
                    console.log(er2 + "-" + er3);
                }
            });
    });

    $("body").on("click", ".e_CargarUsuariosFlujo", function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "f_informeUsuariosFlujo.php",
            beforeSend: function () {
                $(".e_CargarDatosUsuariosFlujo").html(loader());
            },
            data: {},
            success: function (data) {
                $(".e_CargarDatosUsuariosFlujo").html(data);
                $('#FiltroCatDocInf_PaisUsuarios').multiselect({
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

    $("body").on("click", "#Btn_BuscarUsuariosFlujoConsolidado", function (e) {
        e.preventDefault();
        d_fechaIni = $("#filtroUsuariosFlujo_FechaIni").val();
        d_fechaFin = $("#filtroUsuariosFlujo_FechaFin").val();
        d_planta = $("#FiltroCatDocInf_PlantaUsuarios").val();

        $.ajax({
            type: "POST",
            url: "f_informeUsuariosFlujoListar.php",
            beforeSend: function () {
                $(".e_CargarListaUsuariosFlujoConsolidado").html(loader());
            },
            data: {fechaIni: d_fechaIni, fechaFin: d_fechaFin, planta: d_planta},
            success: function (data) {
                if (d_planta != null) {
                    $(".e_CargarListaUsuariosFlujoConsolidado").html(data);
                }else{
                    alert("Selecciona el pais y la planta que deseas consultar");
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("click", ".e_usuariosPasos", function (e) {
        e.preventDefault();

        d_tipo = $(this).attr('data-tip');
        if (d_tipo == '1' || d_tipo == '2' || d_tipo == '3') {
            d_fechaIni = $("#filtroUsuariosFlujo_FechaIni").val();
            d_fechaFin = $("#filtroUsuariosFlujo_FechaFin").val();
            d_planta = $("#FiltroCatDocInf_PlantaUsuarios").val();
            d_usuario = $(this).attr('data-usu');
            d_paso = $(this).attr('data-paso');
            d_nom = $(this).attr('data-nom');
        }
        if (d_tipo == '4' || d_tipo == '5' || d_tipo == '6' || d_tipo == '7' || d_tipo == '8' || d_tipo == '9') {
            d_fechaIni = $("#filtroCicloDocumental_FechaIni").val();
            d_fechaFin = $("#filtroCicloDocumental_FechaFin").val();
            d_planta = $("#FiltroCatDocInf_Planta").val();
            d_usuario = $(this).attr('data-are');// Area
            d_paso = $(this).attr('data-docCod');// Nombre doc y # Paso 
            d_nom = $(this).attr('data-docNom');//Cod doc y nombre paso
        }
        $.ajax({
            type: "POST",
            url: "f_cargarDatosUsuariosPasos.php",
            beforeSend: function () {
                $(".e_cargarDatosUsuariosPasos").html(loader());
            },
            data: {fechaIni: d_fechaIni, fechaFin: d_fechaFin, usuario: d_usuario, paso: d_paso, nom: d_nom, tipo: d_tipo, planta: d_planta},
            success: function (data) {
                $(".e_cargarDatosUsuariosPasos").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });
    $("body").on("click", ".e_usuariosPasos1", function (e) {
        e.preventDefault();


        d_tipo = $(this).attr('data-tip');
        d_fechaIni = $("#filtroCicloDocumental_FechaIni").val();
        d_fechaFin = $("#filtroCicloDocumental_FechaFin").val();
        d_planta = $("#FiltroCatDocInf_Planta").val();
        d_usuario = $(this).attr('data-are');// Area
        d_paso = $(this).attr('data-docCod');// Nombre doc y # Paso 
        d_nom = $(this).attr('data-docNom');//Cod doc y nombre paso
        $.ajax({
            type: "POST",
            url: "f_cargarDatosUsuariosPasos.php",
            beforeSend: function () {
                $(".e_cargarDatosUsuariosPasos1").html(loader());
            },
            data: {fechaIni: d_fechaIni, fechaFin: d_fechaFin, usuario: d_usuario, paso: d_paso, nom: d_nom, tipo: d_tipo, planta: d_planta},
            success: function (data) {
                $(".e_cargarDatosUsuariosPasos1").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });


    $("body").on("click", ".e_cargarHistorialCOnsolidadoUsuario", function (e) {
        e.preventDefault();
        d_codigo = $(this).attr("data-cod");

        $("#vtn_DetalleIngreso").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_verHistorial.php",
            beforeSend: function () {
                $(".info_DetalleIngreso").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_DetalleIngreso").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });




    $("body").on("click", ".e_cargarDatosCatalogo", function (e) {
        e.preventDefault();

        d_tipo = $(this).attr("data-tip");
        d_area = $(this).attr("data-are");
        d_nombre = $(this).attr("data-docNom");
        d_planta = $("#FiltroCatDocInf_Planta").val();

        $.ajax({
            type: "POST",
            url: "f_informeCatalogoListar.php",
            beforeSend: function () {
                $(".e_cargarDatosCatalogoInforme").html(loader());
            },
            data: {tipo: d_tipo, area: d_area, nombre: d_nombre, planta: d_planta},
            success: function (data) {
                $(".e_cargarDatosCatalogoInforme").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });


    $("body").on("click", ".e_cargarCatalogo", function (e) {
        e.preventDefault();


        d_codigo = $(this).attr("data-cod");

        $("#vtn_DetalleIngreso").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_verCatalogo.php",
            beforeSend: function () {
                $(".info_DetalleIngreso").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_DetalleIngreso").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });


});