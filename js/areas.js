$(document).ready(function(e) {
  
  $('#filtrar_Areas').keyup(function () {
    var rex = new RegExp($(this).val(), 'i');
    $('.buscar tr').hide();
    $('.buscar tr').filter(function () {
      return rex.test($(this).text());
    }).show();
  });
  $('#FiltroArea_Pais').multiselect({
    enableCaseInsensitiveFiltering: true,
    includeSelectAllOption: true,
    enableFiltering: true,
    selectAllText: 'Seleccionar Todos',
    nonSelectedText: 'Seleccione...',
    nSelectedText: ' Todos',
    buttonWidth: '100%',
    maxHeight: 400,
    dropUp: true
  });
  d_planta = $("#FiltroArea_Planta").val();
  d_estado = $("#FiltroAreas_Estado").val();
  

  $.ajax({
    type:"POST",
    url:"f_areasListar.php",
    beforeSend: function() {
      $(".info_cargarAreasListar").html(loader());
    },
    data:{ estado: d_estado, planta: d_planta },
    success: function(data) {
      $(".info_cargarAreasListar").html(data);
      $("#tbl_Areas").tablesorter();
    },
    error: function(er1, er2, er3) {
      console.log(er2+"-"+er3);
    }
  });
  
  $("body").on("change", "#FiltroArea_Pais", function(e){
    e.preventDefault();
    
    d_pais = $(this).val();
    d_modulo = $(this).attr('data-mod');
    $.ajax({
			type:"POST",
			url:"f_cargarFiltroPlantas.php",
			beforeSend: function() {
				$(".e_cargarFiltroAreaPlantas").html(loader());
			},
			data:{ d_pais: d_pais, modulo: d_modulo },
			success: function(data) {
				$(".e_cargarFiltroAreaPlantas").html(data);
				$('#FiltroArea_Planta').multiselect({
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
  $("body").on("click", "#Btn_AreasBuscar", function(e){
    e.preventDefault();
    d_planta = $("#FiltroArea_Planta").val();
    d_estado = $("#FiltroAreas_Estado").val();


    $.ajax({
      type:"POST",
      url:"f_areasListar.php",
      beforeSend: function() {
        $(".info_cargarAreasListar").html(loader());
      },
      data:{ estado: d_estado, planta: d_planta },
      success: function(data) {
        $(".info_cargarAreasListar").html(data);
        $("#tbl_Areas").tablesorter();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  $("body").on("click", "#Btn_AreasCrear", function(e){
    e.preventDefault();
    
    $("#vtn_AreasCrear").modal({backdrop: 'static'});
    
    $.ajax({
      type:"POST",
      url:"f_areasCrear.php",
      beforeSend: function() {
        $(".info_AreasCrear").html(loader());
      },
      success: function(data) {
        $(".info_AreasCrear").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });

  });
  
  $("body").on("submit", "#f_areasCrear", function(e){
    e.preventDefault();
    
    d_nombre = $("#f_areasCrear #Area_Nombre").val();
    d_planta = $("#f_areasCrear #Are_Pla_Codigo").val();
    
    $.ajax({
      type:"POST",
      url:"op_areasCrear.php",
      beforeSend: function() {
        bloquearFormulario("f_areasCrear");
        $("#Btn_AreasCrearForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_areasCrear");
        $("#Btn_AreasCrearForm").show();
      },
      data: { nombre: d_nombre, planta: d_planta },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_AreasNotificacionesCrear").modal({backdrop: 'static'});
          $(".info_AreasNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        }else{
          $("#vtn_AreasNotificacionesCrear").modal({backdrop: 'static'});
          $(".info_AreasNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", "#Btn_AreasNotificacionesCrear", function(e){
    e.preventDefault();
    
    window.location.href = "fm_areas.php";
  
  });

  
  $("body").on("click", ".e_cargarAreas", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");
    
    $("#vtn_AreasActualizar").modal({backdrop: 'static'});
    
    $.ajax({
      type:"POST",
      url:"f_areasActualizar.php",
      beforeSend: function() {
        $(".info_AreasActualizar").html(loader());
      },
      data:{ codigo: d_codigo },
      success: function(data) {
        $(".info_AreasActualizar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("submit", "#f_areasActualizar", function(e){
    e.preventDefault();
    
    d_codigo = $("#f_areasActualizar #Area_CodigoAct").val();
    d_nombre = $("#f_areasActualizar #Area_NombreAct").val();
    d_planta = $("#f_areasActualizar #Are_Pla_CodigoAct").val();
    d_estado = $("#f_areasActualizar #Area_EstadoAct").val();
    
    $.ajax({
      type:"POST",
      url:"op_areasActualizar.php",
      beforeSend: function() {
        bloquearFormulario("f_areasActualizar");
        $("#Btn_AreasActualizarForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_areasActualizar");
        $("#Btn_AreasActualizarForm").show();
      },
      data: { codigo: d_codigo, nombre: d_nombre, estado: d_estado, planta: d_planta },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_AreasNotificacionesActualizar").modal({backdrop: 'static'});
          $(".info_AreasNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        }else{
          $("#vtn_AreasNotificacionesActualizar").modal({backdrop: 'static'});
          $(".info_AreasNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
    $("body").on("click", "#Btn_AreasNotificacionesActualizar", function(e){
    e.preventDefault();
      
    $("#vtn_AreasActualizar").modal('hide');
    $("#vtn_AreasNotificacionesActualizar").modal('hide');
    
    d_planta = $("#FiltroArea_Planta").val();
    d_estado = $("#FiltroAreas_Estado").val();


    $.ajax({
      type:"POST",
      url:"f_areasListar.php",
      beforeSend: function() {
        $(".info_cargarAreasListar").html(loader());
      },
      data:{ estado: d_estado, planta: d_planta },
      success: function(data) {
        $(".info_cargarAreasListar").html(data);
        $("#tbl_Areas").tablesorter();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", ".excel_Areas", function(e){
    e.preventDefault();
    
    d_estado = $("#FiltroAreas_Estado").val();
    
    window.location.href = "excel_areas.php?estado="+d_estado+"";
  
  });
});