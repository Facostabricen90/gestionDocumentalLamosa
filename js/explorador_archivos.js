$(document).ready(function(e) {
  d_modulo = $("#TipoMod").val();
  $.ajax({
    type:"POST",
    url:"f_exploradorArchivosOsc.php",
    beforeSend: function() {
      $(".info_cargarExploradorArcListar").html(loader());
    },
    data:{ referencia: 0, modulo: d_modulo },
    success: function(data) {
      $(".info_cargarExploradorArcListar").html(data);
      $('#filtrar_ExploradorArc').keyup(function () {
        var rex = new RegExp($(this).val(), 'i');
        $('.buscar tr').hide();
        $('.buscar tr').filter(function () {
          return rex.test($(this).text());
        }).show();
      });
    },
    error: function(er1, er2, er3) {
      console.log(er2+"-"+er3);
    }
  });

  $("body").on("click", ".e_abrirCarpeta", function(e){
    e.preventDefault();
    d_referencia = $(this).attr('data-cod');
    d_modulo = $("#TipoMod").val();
    $.ajax({
      type:"POST",
      url:"f_exploradorArchivosOsc.php",
      beforeSend: function() {
        $(".info_cargarExploradorArcListar").html(loader());
      },
      data:{ referencia: d_referencia, modulo: d_modulo },
      success: function(data) {
        $(".info_cargarExploradorArcListar").html(data);
        $('#filtrar_ExploradorArc').keyup(function () {
          var rex = new RegExp($(this).val(), 'i');
          $('.buscar tr').hide();
          $('.buscar tr').filter(function () {
            return rex.test($(this).text());
          }).show();
        });
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("click", ".e_agregarCarpeta", function(e){
    e.preventDefault();
    $("#vtn_ExploradorArcCrear").modal({backdrop: 'static'});
    d_referencia = $(this).attr('data-cod');
    d_tipo = $(this).attr('data-tip');
    $.ajax({
      type:"POST",
      url:"f_agregarCarpeta.php",
      beforeSend: function() {
        $(".info_ExploradorArcCrear").html(loader());
      },
      data:{ referencia: d_referencia, tipo: d_tipo },
      success: function(data) {
        $(".info_ExploradorArcCrear").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });

  $("body").on("submit", "#f_exploradorArcCrear", function(e){
    e.preventDefault();
    d_referencia = $("#f_exploradorArcCrear #EArc_Referencia").val();
    d_tipo = $("#f_exploradorArcCrear #EArc_Tipo").val();
    d_nombre = $("#f_exploradorArcCrear #EArc_Nombre").val();
    d_modulo = $("#TipoMod").val();
    if(d_tipo == '2'){
      d_adjunto = $("#f_exploradorArcCrear #i_AdjuntoA1").val();
    }else{
      d_adjunto = -1;
    }
    if(d_tipo == '1'){
      $.ajax({
        type:"POST",
        url:"op_exploradorArcCrear.php",
        beforeSend: function() {
          bloquearFormulario("f_exploradorArcCrear");
          $("#Btn_ExploradorArcCrearForm").hide();
        },
        complete: function() {
          desbloquearFormulario("f_exploradorArcCrear");
          $("#Btn_ExploradorArcCrearForm").show();
        },
        data: { referencia: d_referencia, tipo: d_tipo, nombre: d_nombre, adjunto: d_adjunto, modulo: d_modulo },
        dataType: 'json',
        success: function(rs) {
          if(rs.mensaje == "OK"){
            $("#vtn_ExploradorArcNotificacionesCrear").modal({backdrop: 'static'});
            $(".info_ExploradorArcNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
          }else{
            $("#vtn_ExploradorArcNotificacionesCrear").modal({backdrop: 'static'});
            $(".info_ExploradorArcNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
            mensaje('2', rs.mensaje);
          }
        },
        error: function(er1, er2, er3) {
          console.log(er2+"-"+er3);
        }
      });
    }else if(d_tipo == '2' && d_adjunto != ''){
      $.ajax({
        type:"POST",
        url:"op_exploradorArcCrear.php",
        beforeSend: function() {
          bloquearFormulario("f_exploradorArcCrear");
          $("#Btn_ExploradorArcCrearForm").hide();
        },
        complete: function() {
          desbloquearFormulario("f_exploradorArcCrear");
          $("#Btn_ExploradorArcCrearForm").show();
        },
        data: { referencia: d_referencia, tipo: d_tipo, nombre: d_nombre, adjunto: d_adjunto, modulo: d_modulo },
        dataType: 'json',
        success: function(rs) {
          if(rs.mensaje == "OK"){
            $("#vtn_ExploradorArcNotificacionesCrear").modal({backdrop: 'static'});
            $(".info_ExploradorArcNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
          }else{
            $("#vtn_ExploradorArcNotificacionesCrear").modal({backdrop: 'static'});
            $(".info_ExploradorArcNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
            mensaje('2', rs.mensaje);
          }
        },
        error: function(er1, er2, er3) {
          console.log(er2+"-"+er3);
        }
      });
    }else{
      $(".validarEspera").html('<div class="alert alert-danger">Espere a que el archivo cargue o si no ha cargado ningun archivo por favor carguelo</div>');
    }
  });

  $("body").on("click", "#Btn_ExploradorArcNotificacionesCrear", function(e){
    e.preventDefault();
    d_referencia = $("#f_exploradorArcCrear #EArc_Referencia").val();
    
    d_modulo = $("#TipoMod").val();
    $.ajax({
      type:"POST",
      url:"f_exploradorArchivosOsc.php",
      beforeSend: function() {
        $(".info_cargarExploradorArcListar").html(loader());
      },
      data:{ referencia: d_referencia, modulo: d_modulo },
      success: function(data) {
        $(".info_cargarExploradorArcListar").html(data);
        $('#filtrar_ExploradorArc').keyup(function () {
          var rex = new RegExp($(this).val(), 'i');
          $('.buscar tr').hide();
          $('.buscar tr').filter(function () {
            return rex.test($(this).text());
          }).show();
        });
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
    $("#vtn_ExploradorArcCrear").modal('hide');
    $("#vtn_ExploradorArcNotificacionesCrear").modal('hide');
  });
  
  $("body").on("click", ".e_volverCarpeta", function(e){
    e.preventDefault();
    d_referencia = $(this).attr('data-cod');
    d_modulo = $("#TipoMod").val();
    $.ajax({
      type:"POST",
      url:"f_exploradorArchivosOsc.php",
      beforeSend: function() {
        $(".info_cargarExploradorArcListar").html(loader());
      },
      data:{ referencia: d_referencia, modulo: d_modulo },
      success: function(data) {
        $(".info_cargarExploradorArcListar").html(data);
        $('#filtrar_ExploradorArc').keyup(function () {
          var rex = new RegExp($(this).val(), 'i');
          $('.buscar tr').hide();
          $('.buscar tr').filter(function () {
            return rex.test($(this).text());
          }).show();
        });
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("click", ".e_editarArchivo", function(e){
    e.preventDefault();
    $("#vtn_ExploradorArcActualizar").modal({backdrop: 'static'});
    
    d_codigo = $(this).attr('data-cod');
    d_referencia = $(this).attr('data-ref');
    $.ajax({
      type:"POST",
      url:"f_exploradorArcActualizar.php",
      beforeSend: function() {
        $(".info_ExploradorArcActualizar").html(loader());
      },
      data:{ codigo:d_codigo, referencia: d_referencia },
      success: function(data) {
        $(".info_ExploradorArcActualizar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });

  $("body").on("submit", "#f_exploradorArcActualizar", function(e){
    e.preventDefault();
    d_codigo = $("#f_exploradorArcActualizar #EArc_CodigoAct").val();
    d_referencia = $("#f_exploradorArcActualizar #EArc_ReferenciaAct").val();
    d_nombre = $("#f_exploradorArcActualizar #EArc_NombreAct").val();
    
    $.ajax({
      type:"POST",
      url:"op_exploradorArcActualizar.php",
      beforeSend: function() {
        bloquearFormulario("f_exploradorArcActualizar");
        $("#Btn_ExploradorArcActualizarForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_exploradorArcActualizar");
        $("#Btn_ExploradorArcActualizarForm").show();
      },
      data: { codigo:d_codigo, referencia: d_referencia, nombre: d_nombre },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_ExploradorArcNotificacionesActualizar").modal({backdrop: 'static'});
          $(".info_ExploradorArcNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');

        }else{
          $("#vtn_ExploradorArcNotificacionesActualizar").modal({backdrop: 'static'});
          $(".info_ExploradorArcNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  

  $("body").on("click", "#Btn_ExploradorArcNotificacionesActualizar", function(e){
    e.preventDefault();
    d_referencia = $("#f_exploradorArcActualizar #EArc_ReferenciaAct").val();
    
    d_modulo = $("#TipoMod").val();
    $.ajax({
      type:"POST",
      url:"f_exploradorArchivosOsc.php",
      beforeSend: function() {
        $(".info_cargarExploradorArcListar").html(loader());
      },
      data:{ referencia: d_referencia, modulo: d_modulo },
      success: function(data) {
        $(".info_cargarExploradorArcListar").html(data);
        $('#filtrar_ExploradorArc').keyup(function () {
          var rex = new RegExp($(this).val(), 'i');
          $('.buscar tr').hide();
          $('.buscar tr').filter(function () {
            return rex.test($(this).text());
          }).show();
        });
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
    $("#vtn_ExploradorArcActualizar").modal('hide');
    $("#vtn_ExploradorArcNotificacionesActualizar").modal('hide');
  });
  
  $("body").on("click", ".e_eliminarArchivo", function(e){
    e.preventDefault();
    $("#vtn_EliminarExplorador").modal({backdrop: 'static'});
    d_codigo = $(this).attr('data-cod');
    d_referencia = $(this).attr('data-ref');
    $.ajax({
      type:"POST",
      url:"f_eliminarExplorador.php",
      beforeSend: function() {
        $(".info_EliminarExplorador").html(loader());
      },
      data:{ codigo:d_codigo, referencia: d_referencia },
      success: function(data) {
        $(".info_EliminarExplorador").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("submit", "#f_eliminarExplorador", function(e){
    e.preventDefault();
    d_codigo = $("#f_eliminarExplorador #EArc_CodigoEli").val();
    d_referencia = $("#f_eliminarExplorador #EArc_ReferenciaEli").val();
    $.ajax({
      type:"POST",
      url:"op_eliminarExplorador.php",
      beforeSend: function() {
        bloquearFormulario("f_eliminarExplorador");
        $("#Btn_EliminarExploradorCrearForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_eliminarExplorador");
        $("#Btn_EliminarExploradorCrearForm").show();
      },
      data: { codigo: d_codigo },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          d_referencia = $("#f_eliminarExplorador #EArc_ReferenciaEli").val();
          
          d_modulo = $("#TipoMod").val();
          $.ajax({
            type:"POST",
            url:"f_exploradorArchivosOsc.php",
            beforeSend: function() {
              $(".info_cargarExploradorArcListar").html(loader());
            },
            data:{ referencia: d_referencia, modulo: d_modulo },
            success: function(data) {
              $(".info_cargarExploradorArcListar").html(data);
              $('#filtrar_ExploradorArc').keyup(function () {
                var rex = new RegExp($(this).val(), 'i');
                $('.buscar tr').hide();
                $('.buscar tr').filter(function () {
                  return rex.test($(this).text());
                }).show();
              });
            },
            error: function(er1, er2, er3) {
              console.log(er2+"-"+er3);
            }
          });
          $("#vtn_EliminarExplorador").modal('hide');
        }else{
          mensaje('2', rs.mensaje);
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });

  $("body").on("click", ".e_verDocumento", function(e){
    e.preventDefault();
    $("#vtn_verDocumentoCrear").modal({backdrop: 'static'});
    d_codigo = $(this).attr('data-cod');
    $.ajax({
      type:"POST",
      url:"f_verDocumentoExplorador.php",
      beforeSend: function() {
        $(".info_verDocumentoCrear").html(loader());
      },
      data:{ codigo: d_codigo },
      success: function(data) {
        $(".info_verDocumentoCrear").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });

  

});