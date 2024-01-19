$(document).ready(function(e) {
  
  $('#filtrar_Operarios').keyup(function () {
    var rex = new RegExp($(this).val(), 'i');
    $('.buscar tr').hide();
    $('.buscar tr').filter(function () {
      return rex.test($(this).text());
    }).show();
  });

  $('#FiltroOperario_Pais').multiselect({
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
  d_planta = $("#FiltroOperario_Planta").val();
  
  d_estado = $("#FiltroOperarios_Estado").val();
  d_area = $("#FiltroOperarios_Area").val();
  $.ajax({
    type:"POST",
    url:"f_operariosListar.php",
    beforeSend: function() {
      $(".info_cargarOperariosListar").html(loader());
    },
    data:{ estado: d_estado, area: d_area, planta: d_planta },
    success: function(data) {
      $(".info_cargarOperariosListar").html(data);
      $("#tbl_Operarios").tablesorter();
    },
    error: function(er1, er2, er3) {
      console.log(er2+"-"+er3);
    }
  });
  
  $("body").on("click", "#Btn_OperariosBuscar", function(e){
    e.preventDefault();
    d_planta = $("#FiltroOperario_Planta").val();

    d_estado = $("#FiltroOperarios_Estado").val();
    d_area = $("#FiltroOperarios_Area").val();
    d_subArea = $("#FiltroOperarios_SubAreaNombre").val();
    $.ajax({
      type:"POST",
      url:"f_operariosListar.php",
      beforeSend: function() {
        $(".info_cargarOperariosListar").html(loader());
      },
      data:{ estado: d_estado, area: d_area, subArea: d_subArea , planta: d_planta },
      success: function(data) {
        $(".info_cargarOperariosListar").html(data);
        $("#tbl_Operarios").tablesorter();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });

  
  $("body").on("change", "#FiltroOperario_Pais", function(e){
    e.preventDefault();
    
    d_pais = $(this).val();
    d_modulo = $(this).attr('data-mod');
    $.ajax({
			type:"POST",
			url:"f_cargarFiltroPlantas.php",
			beforeSend: function() {
				$(".e_cargarFiltroOperarioPlantas").html(loader());
			},
			data:{ d_pais: d_pais, modulo: d_modulo },
			success: function(data) {
				$(".e_cargarFiltroOperarioPlantas").html(data);
				$('#FiltroOperario_Planta').multiselect({
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
			error: function(er1, er2, er3) {
				console.log(er2+"-"+er3);
			}
		});		
  });
  

  $("body").on("click", ".e_cargarOperarios", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");
    
    $("#vtn_OperariosActualizar").modal({backdrop: 'static'});
    
    $.ajax({
      type:"POST",
      url:"f_operariosActualizar.php",
      beforeSend: function() {
        $(".info_OperariosActualizar").html(loader());
      },
      data:{ codigo: d_codigo },
      success: function(data) {
        $(".info_OperariosActualizar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  

  $("body").on("click", "#Btn_OperariosCrear", function(e){
    e.preventDefault();
    
    $("#vtn_OperariosCrear").modal({backdrop: 'static'});
    
    $.ajax({
      type:"POST",
      url:"f_operariosCrear.php",
      beforeSend: function() {
        $(".info_OperariosCrear").html(loader());
      },
      success: function(data) {
        $(".info_OperariosCrear").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  
  $("body").on("submit", "#f_operariosCrear", function(e){
    e.preventDefault();
    
    d_nombre = $("#f_operariosCrear #Ope_Nombre").val();
    d_apellido = $("#f_operariosCrear #Ope_Apellido").val();
    d_cedula = $("#f_operariosCrear #Ope_Cedula").val();
    d_correo = $("#f_operariosCrear #Ope_Correo").val();
    d_telefono = $("#f_operariosCrear #Ope_Telefono").val();
    d_area = $("#f_operariosCrear #Ope_Area_Codigo").val();
    d_sexo = $("#f_operariosCrear #Ope_Sexo").val();
    d_codigoccosto = $("#f_operariosCrear #Ope_CodigoCCosto").val();
    d_nombreccosto = $("#f_operariosCrear #Ope_NombreCCosto").val();
    d_jefe = $("#f_operariosCrear #Ope_Jefe").val();
    d_cargo = $("#f_operariosCrear #Ope_Cargo").val();
    d_areaLatam = $("#f_operariosCrear #Ope_AreaLATAM").val();
    d_funcion = $("#f_operariosCrear #Ope_TipoFuncion").val();
    d_gerencia = $("#f_operariosCrear #Ope_Gerencia").val();
    d_subarea = $("#f_operariosCrear #Ope_SubArea").val();
    d_planta = $("#f_operariosCrear #Ope_Pla_Codigo").val();
    
    $.ajax({
      type:"POST",
      url:"op_operariosCrear.php",
      beforeSend: function() {
        bloquearFormulario("f_operariosCrear");
        $("#Btn_OperariosCrearForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_operariosCrear");
        $("#Btn_OperariosCrearForm").show();
      },
      data: { nombre: d_nombre, apellido: d_apellido, cedula: d_cedula, correo: d_correo, telefono: d_telefono, area: d_area, sexo: d_sexo, codigoccosto: d_codigoccosto, nombreccosto: d_nombreccosto, jefe: d_jefe, cargo: d_cargo, areaLatam: d_areaLatam, funcion: d_funcion, gerencia: d_gerencia, subarea: d_subarea, planta: d_planta },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_OperariosNotificacionesCrear").modal({backdrop: 'static'});
          $(".info_OperariosNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        }else{
          $("#vtn_OperariosNotificacionesCrear").modal({backdrop: 'static'});
          $(".info_OperariosNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("change", "#Ope_Pla_Codigo", function (e) {
        e.preventDefault();
        d_planta = $("#f_operariosCrear #Ope_Pla_Codigo").val();

        $.ajax({
            type: "POST",
            url: "f_operariosCrearPorCplanta.php",
            data: {planta: d_planta},
            success: function (rs) {
               $("#Ope_Area_Codigo").html(rs);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });
    
    $("body").on("change", "#Ope_Pla_Codigo", function (e) {
        e.preventDefault();
        d_planta = $("#f_operariosCrear #Ope_Pla_Codigo").val();

        $.ajax({
            type: "POST",
            url: "f_operariosCrearPorCplantaSubArea.php",
            data: {planta: d_planta},
            success: function (rs) {
               $("#Ope_SubArea").html(rs);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });
  
  $("body").on("click", "#Btn_OperariosNotificacionesCrear", function(e){
    e.preventDefault();
    
    window.location.href = "fm_operarios.php";
  
  });
  
  $("body").on("click", ".e_cargarOperarios", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");
    
    $("#vtn_OperariosActualizar").modal({backdrop: 'static'});
    
    $.ajax({
      type:"POST",
      url:"f_operariosActualizar.php",
      beforeSend: function() {
        $(".info_OperariosActualizar").html(loader());
      },
      data:{ codigo: d_codigo },
      success: function(data) {
        $(".info_OperariosActualizar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  
  $("body").on("submit", "#f_operariosActualizar", function(e){
  e.preventDefault();

    d_codigo = $("#f_operariosActualizar #Ope_CodigoAct").val();
    d_nombre = $("#f_operariosActualizar #Ope_NombreAct").val();
    d_apellido = $("#f_operariosActualizar #Ope_ApellidoAct").val();
    d_cedula = $("#f_operariosActualizar #Ope_CedulaAct").val();
    d_correo = $("#f_operariosActualizar #Ope_CorreoAct").val();
    d_telefono = $("#f_operariosActualizar #Ope_TelefonoAct").val();
    d_area = $("#f_operariosActualizar #Ope_Area_CodigoAct").val();
    d_estado = $("#f_operariosActualizar #Ope_EstadoAct").val();
    d_sexo = $("#f_operariosActualizar #Ope_SexoAct").val();
    d_codigoccosto = $("#f_operariosActualizar #Ope_CodigoCCostoAct").val();
    d_nombreccosto = $("#f_operariosActualizar #Ope_NombreCCostoAct").val();
    d_jefe = $("#f_operariosActualizar #Ope_JefeAct").val();
    d_cargo = $("#f_operariosActualizar #Ope_CargoAct").val();
    d_areaLatam = $("#f_operariosActualizar #Ope_AreaLATAMAct").val();
    d_funcion = $("#f_operariosActualizar #Ope_TipoFuncionAct").val();
    d_gerencia = $("#f_operariosActualizar #Ope_GerenciaAct").val();
    d_subarea = $("#f_operariosActualizar #Ope_SubAreaAct").val();
    d_estado = $("#f_operariosActualizar #Ope_EstadoAct").val();
    d_planta = $("#f_operariosActualizar #Ope_Pla_CodigoAct").val();

    $.ajax({
      type:"POST",
      url:"op_operariosActualizar.php",
      beforeSend: function() {
        bloquearFormulario("f_operariosActualizar");
        $("#Btn_OperariosActualizarForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_operariosActualizar");
        $("#Btn_OperariosActualizarForm").show();
      },
      data: { codigo: d_codigo, nombre: d_nombre, apellido: d_apellido, cedula: d_cedula, correo: d_correo, telefono: d_telefono, area: d_area, estado: d_estado, sexo: d_sexo, codigoccosto: d_codigoccosto, nombreccosto: d_nombreccosto, jefe: d_jefe, cargo: d_cargo, areaLatam: d_areaLatam, funcion: d_funcion, gerencia: d_gerencia, subarea: d_subarea, estado: d_estado, planta: d_planta },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_OperariosNotificacionesActualizar").modal({backdrop: 'static'});
          $(".info_OperariosNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        }else{
          $("#vtn_OperariosNotificacionesActualizar").modal({backdrop: 'static'});
          $(".info_OperariosNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  
  $("body").on("click", "#Btn_OperariosNotificacionesActualizar", function(e){
    e.preventDefault();
    
    $("#vtn_OperariosActualizar").modal('hide');
    $("#vtn_OperariosNotificacionesActualizar").modal('hide');
    
      d_planta = $("#FiltroOperario_Planta").val();
  
      d_estado = $("#FiltroOperarios_Estado").val();
      d_area = $("#FiltroOperarios_Area").val();
      $.ajax({
        type:"POST",
        url:"f_operariosListar.php",
        beforeSend: function() {
          $(".info_cargarOperariosListar").html(loader());
        },
        data:{ estado: d_estado, area: d_area, planta: d_planta },
        success: function(data) {
          $(".info_cargarOperariosListar").html(data);
          $("#tbl_Operarios").tablesorter();
        },
        error: function(er1, er2, er3) {
          console.log(er2+"-"+er3);
        }
      });
  
  });
  
  $("body").on("click", ".excel_Operarios", function(e){
    e.preventDefault();
    d_planta = $("#FiltroOperario_Planta").val();
    d_estado = $("#FiltroOperarios_Estado").val();
    d_area = $("#FiltroOperarios_Area").val();
    d_subArea = $("#FiltroOperarios_SubAreaNombre").val();
    
    window.location.href = "excel_operarios.php?estado="+d_estado+"&area="+d_area+"&subArea="+d_subArea+"&planta="+d_planta;
  
  });
  
});