$(document).ready(function(e) {

  $("body").on("change", "#Cat_TipoDocumentoOpe", function(e){
    e.preventDefault();
    
    d_tipoDocOp = $("#Cat_TipoDocumentoOpe").val();

    $.ajax({
      type:"POST",
      url:"f_catalogoDocumentosOperariosListar.php",
      beforeSend: function() {
        $(".info_catalogoDocumentosOpeListar").html(loader());
      },
      data:{ tipo: d_tipoDocOp },
      success: function(data) {
        $(".info_catalogoDocumentosOpeListar").html(data);
        $("#tbl_catalogoDocumentosOpe").tablesorter();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });

});