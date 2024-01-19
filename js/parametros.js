$(document).ready(function(e) {
  
  $('#filtrar_Parametros').keyup(function () {
    var rex = new RegExp($(this).val(), 'i');
    $('.buscar tr').hide();
    $('.buscar tr').filter(function () {
      return rex.test($(this).text());
    }).show();
  });

  d_estado = $("#FiltroParametros_Estado").val();
 
  $.ajax({
    type:"POST",
    url:"f_parametrosListar.php",
    beforeSend: function() {
      $(".info_cargarParametrosListar").html(loader());
    },
    data:{ estado: d_estado },
    success: function(data) {
      $(".info_cargarParametrosListar").html(data);
      $("#tbl_Parametros").tablesorter();
    },
    error: function(er1, er2, er3) {
      console.log(er2+"-"+er3);
    }
  });
  
  $("body").on("change", "#FiltroParametros_Estado", function(e){
    e.preventDefault();
    
    d_estado = $("#FiltroParametros_Estado").val();
  
    $.ajax({
      type:"POST",
      url:"f_parametrosListar.php",
      beforeSend: function() {
        $(".info_cargarParametrosListar").html(loader());
      },
      data:{ estado: d_estado },
      success: function(data) {
        $(".info_cargarParametrosListar").html(data);
        $("#tbl_Parametros").tablesorter();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });

  });

  $("body").on("click", "#Btn_ParametrosCrear", function(e){
    e.preventDefault();
    
    $("#vtn_ParametrosCrear").modal({backdrop: 'static'});
    
    $.ajax({
      type:"POST",
      url:"f_parametrosCrear.php",
      beforeSend: function() {
        $(".info_ParametrosCrear").html(loader());
      },
      success: function(data) {
        $(".info_ParametrosCrear").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("submit", "#f_parametrosCrear", function(e){
    e.preventDefault();
   
    d_nombre = $("#f_parametrosCrear #Par_Nombre").val();
    d_tipo = $("#f_parametrosCrear #Par_Tipo").val();
    d_tipoFlujo = $("#f_parametrosCrear #Par_TipoFlujo").val();
    
    $.ajax({
      type:"POST",
      url:"op_parametrosCrear.php",
      beforeSend: function() {
        bloquearFormulario("f_parametrosCrear");
        $("#Btn_ParametrosCrearForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_parametrosCrear");
        $("#Btn_ParametrosCrearForm").show();
      },
      data: { nombre: d_nombre, tipo: d_tipo, tipoFlujo: d_tipoFlujo },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_ParametrosNotificacionesCrear").modal({backdrop: 'static'});
          $(".info_ParametrosNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        }else{
          $("#vtn_ParametrosNotificacionesCrear").modal({backdrop: 'static'});
          $(".info_ParametrosNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  
  $("body").on("click", "#Btn_ParametrosNotificacionesCrear", function(e){
    e.preventDefault();
    
    window.location.href = "fm_parametros.php";
  
  });
 
  $("body").on("click", ".e_cargarParametros", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");
    
    $("#vtn_ParametrosActualizar").modal({backdrop: 'static'});
    
    $.ajax({
      type:"POST",
      url:"f_parametrosActualizar.php",
      beforeSend: function() {
        $(".info_ParametrosActualizar").html(loader());
      },
      data:{ codigo: d_codigo },
      success: function(data) {
        $(".info_ParametrosActualizar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("submit", "#f_parametrosActualizar", function(e){
    e.preventDefault();
    
    d_codigo = $("#f_parametrosActualizar #Par_CodigoAct").val();
    d_nombre = $("#f_parametrosActualizar #Par_NombreAct").val();
    d_tipo = $("#f_parametrosActualizar #Par_TipoAct").val();
    d_tipoFlujo = $("#f_parametrosActualizar #Par_TipoFlujoAct").val();
    d_estado = $("#f_parametrosActualizar #Par_EstadoAct").val();
    
    $.ajax({
      type:"POST",
      url:"op_parametrosActualizar.php",
      beforeSend: function() {
        bloquearFormulario("f_parametrosActualizar");
        $("#Btn_ParametrosActualizarForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_parametrosActualizar");
        $("#Btn_ParametrosActualizarForm").show();
      },
      data: { codigo: d_codigo, nombre: d_nombre, tipo: d_tipo, estado: d_estado, tipoFlujo: d_tipoFlujo },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_ParametrosNotificacionesActualizar").modal({backdrop: 'static'});
          $(".info_ParametrosNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        }else{
          $("#vtn_ParametrosNotificacionesActualizar").modal({backdrop: 'static'});
          $(".info_ParametrosNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", "#Btn_ParametrosNotificacionesActualizar", function(e){
    e.preventDefault();
    
    $("#vtn_ParametrosActualizar").modal('hide');
    $("#vtn_ParametrosNotificacionesActualizar").modal('hide');
    
    d_estado = $("#FiltroParametros_Estado").val();
  
    $.ajax({
      type:"POST",
      url:"f_parametrosListar.php",
      beforeSend: function() {
        $(".info_cargarParametrosListar").html(loader());
      },
      data:{ estado: d_estado },
      success: function(data) {
        $(".info_cargarParametrosListar").html(data);
        $("#tbl_Parametros").tablesorter();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", ".excel_Parametros", function(e){
    e.preventDefault();
    
    d_estado = $("#FiltroParametros_Estado").val();
    
    window.location.href = "excel_parametros.php?estado="+d_estado+"";
  
  });

});